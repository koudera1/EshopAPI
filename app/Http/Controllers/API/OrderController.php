<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_product;
use App\Currency;
use App\Order_product_move;
use App\Order_total;
use App\Order_historyController;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

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
                DB::raw('(oc_order_product.price-oc_order_product.purchase_price)*oc_order_product.quantity as profit'),
                DB::raw('IF(oc_order.payment_country = "Slovensko",1,0) as slovakia'),
                DB::raw('IF(SELECT SUM(quantity_ext) FROM oc_order_product_move) = 0,1,0 as instock'),
                'oc_order.referrer', 'oc_order.agree_gdpr', 'oc_order.payment_method', 'oc_order.email', 'oc_order.telephone')
            ->groupBy('oc_order.order_id')
            ->get();
    }

    /**
     * Create new order when a customer adds sth to his cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @bodyParam domain required Example: "www.moje_medisana.cz"
     * @bodyParam customer_id required
     * @bodyParam language required Example: "Čeština"
     * @bodyParam ip required ip address
     * @bodyParam referrer required
     * @bodyParam product_id required
     * @bodyParam quantity_int required The number of products from the order in the internal stock.
     * @bodyParam quantity_ext required The number of products from the order in an external stock.
     * @bodyParam quantity required quantity of products
     * další atributy pro sklad
     */
    public function store(Request $request)
    {
        $oid = Order::insertGetId(
            [
                'domain' => $request->input('domain'),
                'customer_id' => $request->input('customer_id'),
                //pokud přihlášený pak 0, jinak přirozené číslo
                'language_id' => DB::table('oc_language')
                    ->where('name', $request->input('language'))->value('language_id'),
                'currency' => $request->input('language') == 'Čeština' ? 'CZK' : 'EUR',
                'currency_id' => $request->input('language') == 'Čeština' ?
                    DB::table('oc_currency')->where('code', 'CZK')->value('currency_id') :
                    DB::table('oc_currency')->where('code', 'EUR')->value('currency_id'),
                'date_modified' => date("Y-m-d H:i:s"),
                'date_added' => date("Y-m-d H:i:s"),
                'ip' => $request->input('ip'),
                'referrer' => $request->input('referrer'),
            ]
        );

        Order_product_move::insert([
            'order_id' => $oid,
            'product_id' => $request->input('product_id'),
            'quantity_int' => $request->input('quantity_int'),
            'quantity_ext' => $request->input('quantity_ext')
        ]);


        $product = DB::table('oc_product')
            ->where('product_id',$request->input('product_id'))->first();
        $opid = Order_product::insertGetId(
            [
                'order_id' => $oid,
                'product_id' => $request->input('product_id'),
                'name' => DB::table('oc_product_description')
                    ->where('product_id',$request->input('product_id'))->value('name'),
                'model' => $product->model,
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'quantity' => $request->input('quantity'),
                'total' => $product->price * $request->input('quantity'),
                'warranty' => $product->warranty,
                'tax' => preg_replace('/[^0-9]/', '', DB::table('oc_tax_class')
                    ->where('tax_class_id',$product->tax_class_id)->value('title'))
            ]
        );

        Product::update(
            [
                'product_id' => $request->input('product_id'),
                //atributy pro internal a external sklad v produktu
            ]
        );

        $op = Order_product::select('total', 'tax')->where('order_product_id', $opid)->first();
        $taxCoeficient = '0.' . str_replace('.', '', $op->tax);
        $tax = $op->total * $taxCoeficient;
        Order::where('order_id', $oid)->update(['total' => ($op->total + $tax)]);

        $request->input('language') === 'Čeština' ? $c ='Kč' : $c ='Euro';

        Order_total::insert(
            [
                'order_id' => $oid,
                'title' => 'Cena celkem bez DPH',
                'text' => $op->total.' '.$c,
                'value' => $op->total,
                'sort_order' => 4
            ]);

        Order_total::insert(
            [
                'order_id' => $oid,
                'title' => 'DPH '.(int)Order_product::where('order_id',$oid)->value('tax').'%',
                'text' => $tax.' '.$c,
                'value' => $tax,
                'sort_order' => 5
            ]);

        Order_total::insert(
            [
                'order_id' => $oid,
                'title' => 'Cena celkem s DPH',
                'text' => ($tax+$op->total).' '.$c,
                'value' => ($tax+$op->total),
                'sort_order' => 6
            ]);

        return response()->json(
            [
                'order_id' => $oid,
                'order_product_id' => $opid
            ]
        );
    }

    /**
     * Display the specified order.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $id = $order->order_id;
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
                DB::raw('(oc_order_product.price-oc_order_product.purchase_price)*oc_order_product.quantity as profit'),
                DB::raw('IF(oc_order.shipping_country = "Slovensko",1,0) as slovakia'),
                DB::raw('IF(SELECT SUM(quantity_ext) FROM oc_order_product_move) = 0,1,0 as instock'),
                'oc_order.referrer', 'oc_order.agree_gdpr', 'oc_order.payment_method', 'oc_order.email', 'oc_order.telephone')
            ->where('oc_order.order_id', $id)
            ->first();
    }

    /**
     * Remove the specified order from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)//ještě smazat navazující tabulky
    {
        $order->delete();
    }


    /**
     * Update the specified order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     *
     * @bodyParam domain Example: "www.moje_medisana.cz"
     * @bodyParam currency
     * @bodyParam language
     * @bodyParam firstname
     * @bodyParam lastname
     * @bodyParam company
     * @bodyParam comment The comment written by the customer.
     * @bodyParam order_status Example: "Nevyřízeno."
     * @bodyParam shipping_mehotd Example: "Zásilkovna"
     * @bodyParam payment_status Whether the order was Example: 1
     * @bodyParam referrer The source website where the customer has come from.
     * @bodyParam agree_gdpr Whether the customer agrees with gdpr policy. Example: 1
     * @bodyParam payment_method
     * @bodyParam email
     * @bodyParam telephone
     * @bodyParam fax
     * @bodyParam regNum In Czech language IČO.
     * @bodyParam email In Czech language DIČO.
     * @bodyParam ip
     * @bodyParam reason
     * @bodyParam wrong_order_id
     * @bodyParam competition
     * @bodyParam euVAT
     * @bodyParam viewed Whether the order has been viewed. Example: 0
     * @bodyParam shipping_firstname
     * @bodyParam shipping_lastname
     * @bodyParam shipping_company
     * @bodyParam shipping_address_1
     * @bodyParam shipping_address_2
     * @bodyParam shipping_city
     * @bodyParam shipping_postcode
     * @bodyParam shipping_zone
     * @bodyParam shipping_zone_id
     * @bodyParam shipping_country
     * @bodyParam shipping_country_id
     * @bodyParam shipping_address_format
     * @bodyParam payment_firstname
     * @bodyParam payment_lastname
     * @bodyParam payment_company
     * @bodyParam payment_address_1
     * @bodyParam payment_address_2
     * @bodyParam payment_city
     * @bodyParam payment_postcode
     * @bodyParam payment_zone
     * @bodyParam payment_zone_id
     * @bodyParam payment_country
     * @bodyParam payment_country_id
     * @bodyParam payment_address_format
     */
    public function update(Request $request, Order $order)
    {
        $ret_array = [];
        if($request->has('domain'))
        {
            $ret_array += array('domain' => response()->json($order->update([
                'domain' => $request->input('domain'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('currency'))
        {
            $ret_array += array('currency' => response()->json($order->update([
                'currency' => $request->input('currency'),
                'currency_id' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('currency_id'),
                'value' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('value'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('language'))
        {
            $ret_array += array('language' => response()->json($order->update([
                'language_id' => DB::table('oc_language')
                    ->where('name', $request->input('language'))
                    ->value('language_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('firstname'))
        {
            $ret_array += array('firstname' => response()->json($order->update([
                'firstname' => $request->input('firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('lastname'))
        {
            $ret_array += array('lastname' => response()->json($order->update([
                'lastname' => $request->input('lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('company'))
        {
            $ret_array += array('company' => response()->json($order->update([
                'company' => $request->input('company'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }

        if($request->has('comment'))
        {
            $ret_array += array('comment' => response()->json($order->update([
                'comment' => $request->input('comment'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('order_status'))
        {
            $ohc = new Order_historyController();
            $osid = DB::table('oc_order_status')->where('name',$request->input('order_status'))
                ->value('order_status_id');
            $ret_array += array('order_status' => response()->json($order->update([
                'order_status_id' => $osid,
                'date_modified' => date("Y-m-d H:i:s")
            ])));
            $ohc->store(response()->json
            ([
                'order_status_id' => $osid,
                'notify' => $request->input('notify'),
                'comment' => $request->input('comment'),
            ]), $order);
        }
        if($request->has('shipping_method'))
        {
            $ret_array += array('shipping_method' => response()->json($order->update([
                'shipping_method' => $request->input('shipping_method'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_status'))
        {
            $ret_array += array('payment_status' => response()->json($order->update([
                'payment_status' => $request->input('payment_status'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('referrer'))
        {
            $ret_array += array('referrer' => response()->json($order->update([
                'referrer' => $request->input('referrer'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('agree_gdpr'))
        {
            $ret_array += array('agree_gdpr' => response()->json($order->update([
                'agree_gdpr' => $request->input('agree_gdpr'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_method'))
        {
            $ret_array += array('payment_method' => response()->json($order->update([
                'payment_method' => $request->input('payment_method'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('email'))
        {
            $ret_array += array('email' => response()->json($order->update([
                'email' => $request->input('email'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('telephone'))
        {
            $ret_array += array('telephone' => response()->json($order->update([
                'telephone' => $request->input('telephone'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('fax'))
        {
            $ret_array += array('fax' => response()->json($order->update([
                'fax' => $request->input('fax'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('regNum'))
        {
            $ret_array += array('regNum' => response()->json($order->update([
                'regNum' => $request->input('regNum'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('taxRegNum'))
        {
            $ret_array += array('taxRegNum' => response()->json($order->update([
                'taxRegNum' => $request->input('taxRegNum'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('coupon_id'))
        {
            $ret_array += array('coupon_id' => response()->json($order->update([
                'coupon_id' => $request->input('coupon_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_gp'))
        {
            $ret_array += array('shipping_gp' => response()->json($order->update([
                'shipping_gp' => $request->input('shipping_gp'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('ip'))
        {
            $ret_array += array('ip' => response()->json($order->update([
                'ip' => $request->input('ip'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('reason'))
        {
            $ret_array += array('reason' => response()->json($order->update([
                'reason' => $request->input('reason'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('wrong_order_id'))
        {
            $ret_array += array('wrong_order_id' => response()->json($order->update([
                'wrong_order_id' => $request->input('wrong_order_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('competition'))
        {
            $ret_array += array('competition' => response()->json($order->update([
                'competition' => $request->input('competition'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('euVAT'))
        {
            $ret_array += array('euVAT' => response()->json($order->update([
                'euVAT' => $request->input('euVAT'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('viewed'))
        {
            $ret_array += array('viewed' => response()->json($order->update([
                'viewed' => $request->input('viewed'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_firstname'))
        {
            $ret_array += array('shipping_firstname' => response()->json($order->update([
                'shipping_firstname' => $request->input('shipping_firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_lastname'))
        {
            $ret_array += array('shipping_lastname' => response()->json($order->update([
                'shipping_lastname' => $request->input('shipping_lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_company'))
        {
            $ret_array += array('shipping_company' => response()->json($order->update([
                'shipping_company' => $request->input('shipping_company'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_address_1'))
        {
            $ret_array += array('shipping_address_1' => response()->json($order->update([
                'shipping_address_1' => $request->input('shipping_address_1'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_address_2'))
        {
            $ret_array += array('shipping_address_2' => response()->json($order->update([
                'shipping_address_2' => $request->input('shipping_address_2'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_city'))
        {
            $ret_array += array('shipping_city' => response()->json($order->update([
                'shipping_city' => $request->input('shipping_city'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_gp'))
        {
            $ret_array += array('shipping_gp' => response()->json($order->update([
                'shipping_gp' => $request->input('shipping_gp'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_postcode'))
        {
            $ret_array += array('shipping_postcode' => response()->json($order->update([
                'shipping_postcode' => $request->input('shipping_postcode'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_zone'))
        {
            $ret_array += array('shipping_zone' => response()->json($order->update([
                'shipping_zone' => $request->input('shipping_zone'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_zone_id'))
        {
            $ret_array += array('shipping_zone_id' => response()->json($order->update([
                'shipping_zone_id' => $request->input('shipping_zone_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_country'))
        {
            $ret_array += array('shipping_country' => response()->json($order->update([
                'shipping_country' => $request->input('shipping_country'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_country_id'))
        {
            $ret_array += array('shipping_country_id' => response()->json($order->update([
                'shipping_country_id' => $request->input('shipping_country_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('shipping_address_format'))
        {
            $ret_array += array('shipping_address_format' => response()->json($order->update([
                'shipping_address_format' => $request->input('shipping_address_format'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_firstname'))
        {
            $ret_array += array('payment_firstname' => response()->json($order->update([
                'payment_firstname' => $request->input('payment_firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_lastname'))
        {
            $ret_array += array('payment_lastname' => response()->json($order->update([
                'payment_lastname' => $request->input('payment_lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_company'))
        {
            $ret_array += array('payment_company' => response()->json($order->update([
                'payment_company' => $request->input('payment_company'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_address_1'))
        {
            $ret_array += array('payment_address_1' => response()->json($order->update([
                'payment_address_1' => $request->input('payment_address_1'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_address_2'))
        {
            $ret_array += array('payment_address_2' => response()->json($order->update([
                'payment_address_2' => $request->input('payment_address_2'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_city'))
        {
            $ret_array += array('payment_city' => response()->json($order->update([
                'payment_city' => $request->input('payment_city'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_postcode'))
        {
            $ret_array += array('payment_postcode' => response()->json($order->update([
                'payment_postcode' => $request->input('payment_postcode'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_zone'))
        {
            $ret_array += array('payment_zone' => response()->json($order->update([
                'payment_zone' => $request->input('payment_zone'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_zone_id'))
        {
            $ret_array += array('payment_zone_id' => response()->json($order->update([
                'payment_zone_id' => $request->input('payment_zone_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_country'))
        {
            $ret_array += array('payment_country' => response()->json($order->update([
                'payment_country' => $request->input('payment_country'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_country_id'))
        {
            $ret_array += array('payment_country_id' => response()->json($order->update([
                'payment_country_id' => $request->input('payment_country_id'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }
        if($request->has('payment_address_format'))
        {
            $ret_array += array('payment_address_format' => response()->json($order->update([
                'payment_address_format' => $request->input('payment_address_format'),
                'date_modified' => date("Y-m-d H:i:s")
            ])));
        }

        return $ret_array;
    }

    /**
     * Display addresses of the order.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getAddresses(Order $order)
    {
        return Order::select('shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1',
            'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_zone', 'shipping_zone_id',
            'shipping_country', 'shipping_country_id', 'shipping_address_format',
            'payment_firstname', 'payment_lastname', 'payment_company','payment_address_1', 'payment_address_2',
            'payment_city', 'payment_postcode', 'payment_zone', 'payment_zone_id',
            'payment_country','payment_country_id', 'payment_address_format')->where('order_id',$order->order_id)->first();
    }

    /**
     * Make a new invoice.
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
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getShipping_methods(Order $order)
    {
        if($order->shipping_country === 'Česká republika')
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
    public function getPayment_methods(Request $request, Order $order)
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
    public function getOrder_statuses(Request $request, Order $order)
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
     * Display a price of the specified order.
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
        if ($payment_method == "Na dobírku" || $payment_method == "Na dobierku"
            || $payment_method == "Hotově") {
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
        }
        else return $base;
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





