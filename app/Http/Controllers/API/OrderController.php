<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_history;
use App\Models\Product;
use App\Models\Order_product;
use App\Models\Currency;
use App\Models\Order_product_move;
use App\Models\Order_total;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

/**
 * @group Order
 */
class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Order::class);
        return Cache::remember('orders', 5, function () {
            return Order
                ::leftjoin('oc_order_status', 'oc_order.order_status_id', '=', 'oc_order_status.order_status_id')
                ->leftjoin('oc_order_product', 'oc_order.order_id', '=', 'oc_order_product.order_id')
                ->leftjoin('geis_package', 'oc_order.order_id', '=', 'geis_package.order_id')
                ->leftjoin('postcz_package', 'oc_order.order_id', '=', 'postcz_package.order_id')
                ->leftjoin('zasilkovna_package', 'oc_order.order_id', '=', 'zasilkovna_package.order_id')
                ->leftjoin('oc_order_product_move', 'oc_order.order_id', '=', 'oc_order_product_move.order_id')
                ->select('oc_order.order_id', 'oc_order.invoice_id', 'oc_order.domain',
                    'oc_order.firstname', 'oc_order.lastname', 'oc_order.comment',
                    'oc_order_status.name as order_status', 'oc_order.shipping_method',
                    DB::raw('IF((geis_package.package_order IS NOT NULL) OR (postcz_package.package_order IS NOT NULL)
                OR (zasilkovna_package.creation_time IS NOT NULL),1,0) as label'),
                    'oc_order.date_added', 'oc_order.total', 'oc_order.payment_status',
                    DB::raw('SUM(oc_order_product.price-oc_order_product.purchase_price) as profit'),
                    DB::raw('IF(oc_order.payment_country = "Slovensko",1,0) as slovakia'),
                    DB::raw('IF((SELECT SUM(quantity_ext) FROM oc_order_product_move) = 0,1,0) as instock'),
                    'oc_order.referrer', 'oc_order.agree_gdpr', 'oc_order.payment_method', 'oc_order.email', 'oc_order.telephone')
                ->groupBy('oc_order.order_id')
                ->get();
        });
    }


    /**
     * Create a new order when a customer adds sth to his cart.
     *
     * @bodyParam domain required Example: "www.moje_medisana.cz"
     * @bodyParam customer_id required Example: 0
     * @bodyParam language required Example: "Čeština"
     * @bodyParam ip required ip address Example: "165.154.213.546"
     * @bodyParam referrer required Example: "Google"
     * @bodyParam product_id required Example: 2400
     * @bodyParam quantity required The quantity of products. Example: 2
     *
     * @response  {
     * "order_id":35022,
     * "order_product_id":3332
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oid = Order::insertGetId(
            [
                'domain' => $request->input('domain'),
                'customer_id' => $request->input('customer_id'),
                'language_id' => DB::table('oc_language')
                    ->where('name', $request->input('language'))->value('language_id'),
                'currency' => $request->input('language') === 'Čeština' ? 'CZK' : 'EUR',
                'currency_id' => $request->input('language') === 'Čeština' ?
                    DB::table('oc_currency')->where('code', 'CZK')->value('currency_id') :
                    DB::table('oc_currency')->where('code', 'EUR')->value('currency_id'),
                'value' => $request->input('language') === 'Čeština' ? 1 : 0.03858025,
                'date_modified' => date("Y-m-d H:i:s"),
                'date_added' => date("Y-m-d H:i:s"),
                'ip' => $request->input('ip'),
                'referrer' => $request->input('referrer'),
            ]
        );

        $order = Order::find($oid);
        $product = Product::find($request->input('product_id'));
        $opmc = new Order_product_moveController();
        $opmc->updateStock($order, $product, $request->input('quantity'));

        $opid = Order_product::insertGetId(
            [
                'order_id' => $oid,
                'product_id' => $request->input('product_id'),
                'name' => DB::table('oc_product_description')
                    ->where('product_id', $request->input('product_id'))->value('name'),
                'model' => $product->model,
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'quantity' => $request->input('quantity'),
                'total' => $product->price * $request->input('quantity'),
                'warranty' => $product->warranty,
                'tax' => preg_replace('/[^0-9]/', '', DB::table('oc_tax_class')
                    ->where('tax_class_id', $product->tax_class_id)->value('title'))
            ]
        );

        $order_product = Order_product::find($opid);
        $otc = new Order_totalController();
        $otc->insertOrUpdate($order, 1);

        return response()->json(
            [
                'order_id' => $oid,
                'order_product_id' => $opid
            ]
        );
    }

    /**
     * Display the specified order.
     * @urlParam order required order id Example: 35022
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $id = $order->order_id;
        return Cache::remember('order' . $id, 5, function () use ($id) {
            return Order::leftjoin('oc_order_history', 'oc_order.order_id', '=', 'oc_order_history.order_id')
                ->leftjoin('oc_order_status', 'oc_order.order_status_id', '=', 'oc_order_status.order_status_id')
                ->leftjoin('oc_order_product', 'oc_order.order_id', '=', 'oc_order_product.order_id')
                ->leftjoin('geis_package', 'oc_order.order_id', '=', 'geis_package.order_id')
                ->leftjoin('postcz_package', 'oc_order.order_id', '=', 'postcz_package.order_id')
                ->leftjoin('zasilkovna_package', 'oc_order.order_id', '=', 'zasilkovna_package.order_id')
                ->leftjoin('oc_order_product_move', 'oc_order.order_id', '=', 'oc_order_product_move.order_id')
                ->select('oc_order.order_id', 'oc_order.invoice_id', 'oc_order.domain',
                    'oc_order.firstname', 'oc_order.lastname', 'oc_order.comment',
                    'oc_order_status.name as order_status', 'oc_order.shipping_method',
                    DB::raw('IF((geis_package.package_order IS NOT NULL) OR (postcz_package.package_order IS NOT NULL)
                    OR (zasilkovna_package.creation_time IS NOT NULL),1,0) as label'),
                    'oc_order.date_added', 'oc_order.total', 'oc_order.payment_status',
                    DB::raw('SUM((oc_order_product.price-oc_order_product.purchase_price)) as profit'),
                    DB::raw('(IF(oc_order.shipping_country = "Slovensko",1,0)) as slovakia'),
                    DB::raw('(IF((SELECT SUM(quantity_ext) FROM oc_order_product_move) = 0,1,0)) as instock'),
                    'oc_order.referrer', 'oc_order.agree_gdpr', 'oc_order.payment_method', 'oc_order.email', 'oc_order.telephone')
                ->where('oc_order.order_id', $id)
                ->first();
        });
    }

    /**
     * Remove the specified order from storage.
     * @urlParam order required order id Example: 35022
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @response true
     */
    public function destroy(Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        if($order->delete())
        {
            if(Order_history::where('order_id', $order->order_id)->delete())
            {
                if(Order_product::where('order_id', $order->order_id)->delete())
                {
                    if(Order_product_move::where('order_id', $order->order_id)->delete())
                    {
                        if(Order_total::where('order_id', $order->order_id)->delete())
                        {
                            return response()->json(true);
                        }
                    }
                }
            }
        }
        return response()->json(false);
    }


    /**
     * Update the specified order in storage.
     * @urlParam order required order id Example: 35022
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     *
     * @bodyParam domain string Example: "www.stylka.cz"
     * @bodyParam currency string
     * @bodyParam language string
     * @bodyParam firstname string
     * @bodyParam lastname string
     * @bodyParam company string
     * @bodyParam comment string The comment written by the customer.
     * @bodyParam order_status string Example: "Nevyřízeno."
     * @bodyParam shipping_method string Example: "Zásilkovna"
     * @bodyParam payment_status integer Whether the order was paid. Example: 1
     * @bodyParam referrer string The source website where the customer has come from.
     * @bodyParam agree_gdpr integer Whether the customer agrees with gdpr policy. Example: 1
     * @bodyParam payment_method string
     * @bodyParam email string
     * @bodyParam telephone string
     * @bodyParam fax string
     * @bodyParam regNum string In Czech language IČO.
     * @bodyParam email string In Czech language DIČO.
     * @bodyParam ip string
     * @bodyParam reason string Example: "Reklamace"
     * @bodyParam wrong_order_id integer
     * @bodyParam competition integer
     * @bodyParam euVAT integer
     * @bodyParam viewed integer Whether the order has been viewed. Example: 0
     * @bodyParam shipping_firstname string
     * @bodyParam shipping_lastname string
     * @bodyParam shipping_company string
     * @bodyParam shipping_address_1 string
     * @bodyParam shipping_address_2 string
     * @bodyParam shipping_city string
     * @bodyParam shipping_postcode string
     * @bodyParam shipping_zone string
     * @bodyParam shipping_zone_id integer
     * @bodyParam shipping_country string
     * @bodyParam shipping_country_id integer
     * @bodyParam shipping_address_format string
     * @bodyParam payment_firstname string
     * @bodyParam payment_lastname string
     * @bodyParam payment_company string
     * @bodyParam payment_address_1 string
     * @bodyParam payment_address_2 string
     * @bodyParam payment_city string
     * @bodyParam payment_postcode string
     * @bodyParam payment_zone string
     * @bodyParam payment_zone_id integer
     * @bodyParam payment_country string
     * @bodyParam payment_country_id integer
     * @bodyParam payment_address_format string
     *
     * @response  {
     * "domain":true,
     * "currency":true
     * }
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $ret_array = [];
        if ($request->has('domain')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('domain' => $order->update([
                'domain' => $request->input('domain'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('customer_id')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('customer_id' => $order->update([
                'customer_id' => $request->input('customer_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('currency')) {
            $bool1 = $order->update([
                'currency' => $request->input('currency'),
                'currency_id' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('currency_id'),
                'value' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('value'),
                'date_modified' => date("Y-m-d H:i:s")
            ]);

            $otc = new Order_totalController();
            $bool2 = $otc->insertOrUpdate($order);

            if ($bool1 and $bool2) $ret_array += array('currency' => true);
            else $ret_array += array('currency' => false);

            $ret_array += array('currency' => true);
        }
        if ($request->has('language')) {
            $ret_array += array('language' => $order->update([
                'language_id' => DB::table('oc_language')
                    ->where('name', $request->input('language'))
                    ->value('language_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('firstname')) {
            $ret_array += array('firstname' => $order->update([
                'firstname' => $request->input('firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('lastname')) {
            $ret_array += array('lastname' => $order->update([
                'lastname' => $request->input('lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('company')) {
            $ret_array += array('company' => $order->update([
                'company' => $request->input('company'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }

        if ($request->has('comment')) {
            $ret_array += array('comment' => $order->update([
                'comment' => $request->input('comment'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('order_status')) {
            $this->authorize('updateByAdmin', $order);
            $osid = DB::table('oc_order_status')->where('name', $request->input('order_status'))
                ->value('order_status_id');
            $ret_array += array('order_status' => $order->update([
                'order_status_id' => $osid,
                'date_modified' => date("Y-m-d H:i:s")
            ]));
            Order_history::insert([
                'order_id' => $order->order_id,
                'order_status_id' => $osid,
                'notify' => $request->input('notify'),
                'comment' => $request->input('comment'),
                'date_added' => date("Y-m-d H:i:s")
            ]);
    }
        if ($request->has('shipping_method')) {
            $ret_array += array('shipping_method' => $order->update([
                'shipping_method' => $request->input('shipping_method'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_status')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('payment_status' => $order->update([
                'payment_status' => $request->input('payment_status'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('referrer')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('referrer' => $order->update([
                'referrer' => $request->input('referrer'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('agree_gdpr')) {
            $ret_array += array('agree_gdpr' => $order->update([
                'agree_gdpr' => $request->input('agree_gdpr'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_method')) {
            $ret_array += array('payment_method' => $order->update([
                'payment_method' => $request->input('payment_method'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('email')) {
            $ret_array += array('email' => $order->update([
                'email' => $request->input('email'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('telephone')) {
            $ret_array += array('telephone' => $order->update([
                'telephone' => $request->input('telephone'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('fax')) {
            $ret_array += array('fax' => $order->update([
                'fax' => $request->input('fax'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('regNum')) {
            $ret_array += array('regNum' => $order->update([
                'regNum' => $request->input('regNum'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('taxRegNum')) {
            $ret_array += array('taxRegNum' => $order->update([
                'taxRegNum' => $request->input('taxRegNum'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('coupon_id')) {
            $ret_array += array('coupon_id' => $order->update([
                'coupon_id' => $request->input('coupon_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_gp')) {
            $ret_array += array('shipping_gp' => $order->update([
                'shipping_gp' => $request->input('shipping_gp'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('ip')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('ip' => $order->update([
                'ip' => $request->input('ip'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('reason')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('reason' => $order->update([
                'reason' => $request->input('reason'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('wrong_order_id')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('wrong_order_id' => $order->update([
                'wrong_order_id' => $request->input('wrong_order_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('competition')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('competition' => $order->update([
                'competition' => $request->input('competition'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('euVAT')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('euVAT' => $order->update([
                'euVAT' => $request->input('euVAT'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('viewed')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('viewed' => $order->update([
                'viewed' => $request->input('viewed'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_firstname')) {
            $ret_array += array('shipping_firstname' => $order->update([
                'shipping_firstname' => $request->input('shipping_firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_lastname')) {
            $ret_array += array('shipping_lastname' => $order->update([
                'shipping_lastname' => $request->input('shipping_lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_company')) {
            $ret_array += array('shipping_company' => $order->update([
                'shipping_company' => $request->input('shipping_company'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_address_1')) {
            $ret_array += array('shipping_address_1' => $order->update([
                'shipping_address_1' => $request->input('shipping_address_1'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_address_2')) {
            $ret_array += array('shipping_address_2' => $order->update([
                'shipping_address_2' => $request->input('shipping_address_2'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_city')) {
            $ret_array += array('shipping_city' => $order->update([
                'shipping_city' => $request->input('shipping_city'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_gp')) {
            $ret_array += array('shipping_gp' => $order->update([
                'shipping_gp' => $request->input('shipping_gp'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_postcode')) {
            $ret_array += array('shipping_postcode' => $order->update([
                'shipping_postcode' => $request->input('shipping_postcode'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_zone')) {
            $ret_array += array('shipping_zone' => $order->update([
                'shipping_zone' => $request->input('shipping_zone'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_zone_id')) {
            $ret_array += array('shipping_zone_id' => $order->update([
                'shipping_zone_id' => $request->input('shipping_zone_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_country')) {
            $ret_array += array('shipping_country' => $order->update([
                'shipping_country' => $request->input('shipping_country'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_country_id')) {
            $ret_array += array('shipping_country_id' => $order->update([
                'shipping_country_id' => $request->input('shipping_country_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_address_format')) {
            $ret_array += array('shipping_address_format' => $order->update([
                'shipping_address_format' => $request->input('shipping_address_format'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_firstname')) {
            $ret_array += array('payment_firstname' => $order->update([
                'payment_firstname' => $request->input('payment_firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_lastname')) {
            $ret_array += array('payment_lastname' => $order->update([
                'payment_lastname' => $request->input('payment_lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_company')) {
            $ret_array += array('payment_company' => $order->update([
                'payment_company' => $request->input('payment_company'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_address_1')) {
            $ret_array += array('payment_address_1' => $order->update([
                'payment_address_1' => $request->input('payment_address_1'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_address_2')) {
            $ret_array += array('payment_address_2' => $order->update([
                'payment_address_2' => $request->input('payment_address_2'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_city')) {
            $ret_array += array('payment_city' => $order->update([
                'payment_city' => $request->input('payment_city'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_postcode')) {
            $ret_array += array('payment_postcode' => $order->update([
                'payment_postcode' => $request->input('payment_postcode'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_zone')) {
            $ret_array += array('payment_zone' => $order->update([
                'payment_zone' => $request->input('payment_zone'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_zone_id')) {
            $ret_array += array('payment_zone_id' => $order->update([
                'payment_zone_id' => $request->input('payment_zone_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_country')) {
            $ret_array += array('payment_country' => $order->update([
                'payment_country' => $request->input('payment_country'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_country_id')) {
            $ret_array += array('payment_country_id' => $order->update([
                'payment_country_id' => $request->input('payment_country_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('payment_address_format')) {
            $ret_array += array('payment_address_format' => $order->update([
                'payment_address_format' => $request->input('payment_address_format'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }

        return $ret_array;
    }

    /**
     * Display the addresses of the order.
     * @urlParam order required order id Example: 35022
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getAddresses(Order $order)
    {
        $this->authorize('view', $order);
        return Order::select('shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1',
            'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_zone', 'shipping_zone_id',
            'shipping_country', 'shipping_country_id', 'shipping_address_format',
            'payment_firstname', 'payment_lastname', 'payment_company', 'payment_address_1', 'payment_address_2',
            'payment_city', 'payment_postcode', 'payment_zone', 'payment_zone_id',
            'payment_country', 'payment_country_id', 'payment_address_format')->where('order_id', $order->order_id)->first();
    }

    /**
     * Make a new invoice.
     * @urlParam order required order id Example: 35202
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function putInvoice(Order $order)
    {
        $year = date("Y");
        $invoice_number = Order::where('invoice_id', 'NOT LIKE', 'O%')->max('invoice_id');
        //O pro opravy čísla, nikoli pro novou objednávku

        if (strpos($invoice_number, $year) == false) {
            $invoice_id = $year . '0001';
        } else {
            $sstr = substr($invoice_number, -4, 4);
            $sstr += 1;
            $invoice_id = $year . $sstr;
        }

        return response()->json($order->update([
            'invoice_id' => $invoice_id,
            'invoice_date' => date("Y-m-d H:i:s"),
        ]));
    }

    /**
     * Display all shipping methods.
     * @urlParam order required order id Example: 35022
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getShipping_methods(Order $order)
    {
        if ($order->shipping_country === 'Česká republika')
            return ["Česká pošta (Balík Do balíkovny)", "Česká pošta (Balík Do ruky)",
                "Česká pošta (Balík Na poštu)", "Geis",
                "Zásilkovna", "DPD"];

        else if ($order->shipping_country === 'Slovensko')
            return ["Slovenská pošta", "Geis Slovensko", "Zásielkovňa", "GLS"];
    }


    /**
     * Display all payment methods.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getPayment_methods()
    {
        return ["Na dobírku", "Platba kartou", "Bankovní převod", "Hotově"];
    }

    /**
     * Display all order statuses.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getOrder_statuses()
    {
        return
            ["Nevyřízeno",
                "Ve zpracování",
                "Odesláno dopravcem",
                "Zákazník převzal zboží",
                "Zrušeno obchodem",
                "Nepřevzal zásilku",
                "Dobropisováno",
                "Připraveno k osobnímu odběru",
                "Čeká na uhrazení",
                "Uhrazeno - k expedici",
                "K expedici",
                "Vráceno ve 14ti dnech",
                "Zrušeno zákazníkem",
                "Zrušeno pro nezaplacení",
                "Dobropis",
                "Pouze zásilka"];
    }

    /**
     * Display the price of the specified order.
     *
     * @urlParam order required order id Example: 35022
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getPrice(Order $order)
    {
        $sm_transcript = "";
        switch ($order->shipping_method) {
            case "Česká pošta (Balík Do ruky)":
                $sm_transcript = "shipping:ceska_posta_dr:";
                break;
            case "Česká pošta (Balík Na poštu)":
                $sm_transcript = "shipping:ceska_posta_np:";
                break;
            case "Česká pošta (Balík Do balíkovny)":
                $sm_transcript = "shipping:ceska_posta_balikomat:";
                break;
            case "Slovenská pošta":
                $sm_transcript = "shipping:zasilkovna_sk_post:";
                break;
            case "Zásilkovna":
                $sm_transcript = "shipping:zasilkovna_cz:";
                break;
            case "Zásielkovňa":
                $sm_transcript = "shipping:zasilkovna_sk:";
                break;
            case "GLS":
                $sm_transcript = "shipping:zasilkovna_sk_gls:";
                break;
            case "DPD":
                $sm_transcript = "shipping:zasilkovna_cz_dpd:";
                break;
            case "Geis":
                $sm_transcript = "shipping:geis:";
                break;
            case "Geis Slovensko":
                $sm_transcript = "shipping:geis_sk:";
                break;
            default:
                return response()->json(false);
        }

        $product_ids = DB::table('oc_order_product')
            ->where('order_id', $order->order_id)
            ->pluck('product_id');

        $free_shipping = 0;
        foreach ($product_ids as $product_id) {
            $free_shipping = DB::table('oc_product')
                ->where('product_id', $product_id)
                ->value('free_shipping');
            if ($free_shipping == 1) {
                break;
            }
        }
        $total = Order::where('order_id', $order->order_id)->value('total');
        $key = $sm_transcript . "base";
        $domain_setup = DB::table('oc_domain_setup')
            ->where('key', $key)
            ->where('domain', $order->domain)
            ->value('value');
        $base = $this->domain_setupValue($domain_setup, $free_shipping, $total);
        if ($base === false) return response()->json(false);

        $payment_method = Order::where('order_id', $order->order_id)->value('payment_method');
        if ($payment_method === "Na dobírku" || $payment_method === "Na dobierku"
            || $payment_method === "Hotově") {
            $c = new Currency;
            $key = $sm_transcript . "cod";
            $domain_setup = DB::table('oc_domain_setup')
                ->where('key', $key)->value('value');
            $cod = $this->domain_setupValue($domain_setup, $free_shipping, $total);
            if ($cod === false) return response()->json(false);
            if (strpos($base, "<EUR>") and strpos($cod, "<EUR>")) {
                $base = str_replace("<EUR>", "", $base);
                $cod = str_replace("<EUR>", "", $cod);
                return ($base + $cod) . "<EUR>";
            } elseif ((strpos($base, "<EUR>") and !strpos($cod, "<EUR>"))) {
                //v korunách
                $base = str_replace("<EUR>", "", $base);
                $base = $base / Currency::getEuroValue();
                return $base + $cod;

            } elseif (!(strpos($base, "<EUR>")) and strpos($cod, "<EUR>")) {
                $cod = str_replace("<EUR>", "", $cod);
                $cod = $cod / Currency::getEuroValue();
                return $base + $cod;
            } else return $base + $cod;
        } else return $base;
    }

    public function domain_setupValue($domain_setup, $free_shipping, $total)
    {
        $arr = explode(",", $domain_setup);
        foreach ($arr as $el) {
            if ($el[0] === 'f') {
                if ($free_shipping === 1) {
                    $val = 0;
                    return $val;
                } else {
                    continue;
                }
            } elseif (is_numeric($el[0])) {
                $arr2 = explode(":", $el);
                if (strpos($arr2[0], "<EUR>") and strpos($total, "<EUR>")) {
                    $arr2[0] = str_replace("<EUR>", "", $arr2[0]);
                    $total = str_replace("<EUR>", "", $total);
                } elseif ((strpos($arr2[0], "<EUR>") and !strpos($total, "<EUR>"))) {
                    //v korunách
                    $arr2[0] = str_replace("<EUR>", "", $arr2[0]);
                    $arr2[0] = $arr2[0] / Currency::getEuroValue();
                } elseif (!(strpos($arr2[0], "<EUR>")) and (strpos($total, "<EUR>"))) {
                    $total = str_replace("<EUR>", "", $total);
                    $value = Currency::getEuroValue();
                    $total = $total / $value;
                }
                if ($total <= $arr2[0]) {
                    $val = $arr2[1];
                    return $val;
                } else {
                    continue;
                }
            } elseif ($el[0] === ':') {
                $val = ltrim($el, ':');
                return $val;
            } else return false;
        }
    }
}





