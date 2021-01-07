<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrder;
use App\Models\Address;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_history;
use App\Models\Product;
use App\Models\Order_product;

use App\Models\Order_total;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\Order_totalService;
use App\Services\Order_product_moveService;

/**
 * @group Order
 */
class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     *
     * @response  {[
     * "order_id":35000,
     * "invoice_id":2018023,
     * "domain":'www.stylka.cz',
     * "firstname":'Jan',
     * "lastname":'Zelený',
     * "comment":'Objednávka zaplacena.',
     * "order_status":'Odesláno dopravcem'
     * "shipping_method":'Zásilkovna',
     * "label":1,
     * "date_added":"2018-07-13",
     * "total":453,
     * "payment_status":1,
     * "payment_status" => 1,
     * "profit" => 420,
     * "slovakia" => 0,
     * "instock" => 0,
     * "referrer" => 'Google',
     * "agree_gdpr" => 1,
     * "payment_method" => 'Platba kartou',
     * "email" => 'o@gmail.com',
     * "telephone" => '+420555111444',
     * ]}
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('accessByAdmin', Order::class);
        return Cache::remember('orders', 5, function () {
            return Order
                ::getInformation()
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
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $order = Order::create(
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
                'ip' => $request->input('ip', ''),
                'referrer' => $request->input('referrer'),
            ]
        );
        $oid = $order->order_id;

        if($request->input('customer_id') != 0)
        {
            $customer = Customer::getById($request->input('customer_id'));
            $address = Address::findOrFail($customer->address_id);
            $country = "";
            switch($address->country_id)
            {
                case 56:
                    $country = 'Česká republika';
                    break;
                case 189:
                    $country = 'Slovensko';
                    break;
                default:
                    $country = Country
                        ::where('country_id', $address->country_id)->value('name');
            }

           $order->update(
                [
                    'firstname' => $customer->firstname,
                    'lastname' => $customer->lastname,
                    'email' => $customer->email,
                    'telephone' => $customer->telephone,
                    'fax' => $customer->fax,
                    'ip' => $customer->ip,
                    'company' => $address->company,
                    'shipping_firstname' => $customer->firstname,
                    'shipping_lastname' => $customer->lastname,
                    'payment_firstname' => $customer->firstname,
                    'payment_lastname' => $customer->lastname,
                    'shipping_company' => $address->company,
                    'payment_company' => $address->company,
                    'shipping_address_1' => $address->address_1,
                    'shipping_address_2' => $address->address_2,
                    'payment_address_1' => $address->address_1,
                    'payment_address_2' => $address->address_2,
                    'shipping_postcode' => $address->postcode,
                    'payment_postcode' => $address->postcode,
                    'shipping_city' => $address->city,
                    'payment_city' => $address->city,
                    'shipping_country_id' => $address->country_id,
                    'payment_country_id' => $address->country_id,
                    'shipping_country' => $country,
                    'payment_country' => $country,
                    'shipping_zone_id' => $address->zone_id,
                    'payment_zone_id' => $address->zone_id
                ]
            );
        }

        $request = new Request([
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);
        $opc = new Order_productController();
        $order_total = $opc->store($request, $order);

        return response()->json(
            [
                'order_id' => $oid,
                'order_product_id' => $order_total['order_product_id'],
                'noTaxTotal' => $order_total['noTaxTotal'],
                'tax' => $order_total['tax'],
                'total' => $order_total['total']
            ]
        );
    }

     /**
     * Display the specified order.
     * @urlParam order required order id Example: 35022
     * @response  {
      * "order_id":35000,
      * "invoice_id":2018023,
      * "domain":'www.stylka.cz',
      * "firstname":'Jan',
      * "lastname":'Zelený',
      * "comment":'Objednávka zaplacena.',
      * "order_status":'Odesláno dopravcem'
      * "shipping_method":'Zásilkovna',
      * "label":1,
      * "date_added":2018-07-13,
      * "total":453,
      * "payment_status":1,
      * "payment_status" => 1,
      * "profit" => 420,
      * "slovakia" => 0,
      * "instock" => 0,
      * "referrer" => 'Google',
      * "agree_gdpr" => 1,
      * "payment_method" => 'Platba kartou',
      * "email" => 'o@gmail.com',
      * "telephone" => '+420555111444',
      * }
     * @param Order $order
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Order $order)
    {
        $this->authorize('accessByAdminOrCustomer', $order);
        $id = $order->order_id;
        return Cache::remember('order' . $id, 5, function () use ($id) {
            return Order::getInformation()
                ->groupBy('oc_order.order_id')
                ->having('oc_order.order_id', $id)
                ->first();
        });
    }

    /**
     * Remove the specified order from storage.
     * @urlParam order required order id Example: 35022
     * @response true
     *
     * @param Order $order
     * @return Response
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $ops =  Order_product::getOrderProductsOfAnOrder($order->order_id);
        foreach ($ops as $op)
        {
            Order_product_moveService::updateProductsWhenDeleting($op, Product::find($op->product_id));
            $op->delete();
        }
        Order_total::where('order_id', $order->order_id)->delete();
        Order_history::where('order_id', $order->order_id)->delete();
        return response()->json($order->delete());
    }


    /**
     * Update the specified order in storage.
     * @urlParam order required order id Example: 35022
     * @bodyParam domain string Example: "www.stylka.cz"
     * @bodyParam currency string
     * @bodyParam customer_id integer
     * @bodyParam language string
     * @bodyParam firstname string
     * @bodyParam lastname string
     * @bodyParam company string
     * @bodyParam comment_c string The comment written by the customer.
     * @bodyParam comment_e string The comment written by somebody else than customer.
     * @bodyParam notify string
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
     * @bodyParam taxRegNum string In Czech language DIČO.
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
     * @bodyParam shipping_country string
     * @bodyParam shipping_address_format string
     * @bodyParam payment_firstname string
     * @bodyParam payment_lastname string
     * @bodyParam payment_company string
     * @bodyParam payment_address_1 string
     * @bodyParam payment_address_2 string
     * @bodyParam payment_city string
     * @bodyParam payment_postcode string
     * @bodyParam payment_zone string
     * @bodyParam payment_country string
     * @bodyParam payment_address_format string
     *
     * @response  {
     * "domain":true,
     * "currency":true,
     * "noTaxTotal":100,
     * "tax":21,
     * "total":121
     * }
     *
     * @param UpdateOrder $request
     * @param Order $order
     * @return array
     * @throws AuthorizationException
     */
    public function update(UpdateOrder $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $request->validated();
        $ret_array = [];
        if ($request->has('domain')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('domain' => $order->update([
                'domain' => $request->input('domain')
            ]));
        }
        if ($request->has('customer_id')) {
            $this->authorize('updateByAdminOrCustomer', $order);
            if($order->customer_id != 0 and $request->has('customer_id') != 0)
                abort(403);
            $ret_array += array('customer_id' => $order->update([
                'customer_id' => $request->input('customer_id')
            ]));
        }
        if ($request->has('currency')) {
            $bool1 = $order->update([
                'currency' => $request->input('currency'),
                'currency_id' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('currency_id'),
                'value' => DB::table('oc_currency')
                    ->where('code', $order->currency)->value('value')
            ]);

            $order_total = Order_totalService::updateOrInsert($order, null, 0, "currency");
            if ($bool1)
                $ret_array +=
                    [
                        'currency' => true,
                        'noTaxTotal' => $order_total['noTaxTotal'],
                        'tax' => $order_total['tax'],
                        'total' => $order_total['total']
                    ];
            else $ret_array += array('currency' => false);

            $ret_array += array('currency' => true);
        }
        if ($request->has('language')) {
            $ret_array += array('language' => $order->update([
                'language_id' => DB::table('oc_language')
                    ->where('name', $request->input('language'))
                    ->value('language_id')
            ]));
        }
        if ($request->has('firstname')) {
            $ret_array += array('firstname' => $order->update([
                'firstname' => $request->input('firstname')
            ]));
        }
        if ($request->has('lastname')) {
            $ret_array += array('lastname' => $order->update([
                'lastname' => $request->input('lastname')
            ]));
        }
        if ($request->has('company')) {
            $ret_array += array('company' => $order->update([
                'company' => $request->input('company')
            ]));
        }

        if ($request->has('comment_c')) {
            $ret_array += array('comment_c' => $order->update([
                'comment' => $request->input('comment_c')
            ]));
        }
        if ($request->has('order_status')) {
            $this->authorize('updateByAdmin', $order);
            $osid = DB::table('oc_order_status')->where('name', $request->input('order_status'))
                ->value('order_status_id');
            $ret_array += array('order_status' => $order->update([
                'order_status_id' => $osid
            ]));
            Order_history::create([
                'order_id' => $order->order_id,
                'order_status_id' => $osid,
                'notify' => $request->input('notify'),
                'comment' => $request->input('comment_e'),
            ]);
    }
        if ($request->has('shipping_method')) {
            $ret_array += array('shipping_method' => $order->update([
                'shipping_method' => $request->input('shipping_method')
            ]));
            $origNoTax = $origTax = 0;
            Order_totalService::getOrder_totalValue($order->order_id, $origNoTax, $origTax);
            $price = OrderService::getTransitOrCODPrice
            ($order, "base", $request->input('shipping_method'));
            $ret_array +=
                [
                    'noTaxTotal' => round($origNoTax + 100/121 * $price, 4),
                    'tax' => round($origTax + 21/121 * $price, 4),
                    'total' => round($origTax + $origNoTax + $price, 4),
                    'transitPrice' => $price,
                ];
        }
        if ($request->has('payment_status')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('payment_status' => $order->update([
                'payment_status' => $request->input('payment_status')
            ]));
        }
        if ($request->has('referrer')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('referrer' => $order->update([
                'referrer' => $request->input('referrer')
            ]));
        }
        if ($request->has('agree_gdpr')) {
            $ret_array += array('agree_gdpr' => $order->update([
                'agree_gdpr' => $request->input('agree_gdpr')
            ]));
        }
        if ($request->has('payment_method')) {
            $ret_array += array('payment_method' => $order->update([
                'payment_method' => $request->input('payment_method')
            ]));
            if ($order->payment_method != "Na dobírku" and $order->payment_method != "Na dobierku") $paymentPrice = 0;
            else $paymentPrice = OrderService
                ::getTransitOrCODPrice($order, "cod", $order->shipping_method);
            $transitPrice = OrderService
                ::getTransitOrCODPrice($order, "base", $order->shipping_method);

            $op = Order_product::create(
                [
                    'order_id' => $order->order_id,
                    'product_id' => 0,
                    'name' => $order->shipping_method . ' + ' . $order->payment_method,
                    'tax' => 21.0000,
                    'quantity' => 1,
                    'sort_order' => 18,
                    'is_transfer' => 1,
                    'is_action' => 0,
                    'gift' => 0,
                    'model' => '',
                    'price' => round(($paymentPrice + $transitPrice) * 100/121, 4),
                    'purchase_price' => OrderService::getTransitAndPaymentPurchasePrice($order),
                    'warranty' => 24,
                    'total' =>  round(($paymentPrice + $transitPrice) * 100/121, 4)
                ]);
            $order_total = Order_totalService::updateOrInsert($order, $op, 1, "add");
            $ret_array +=
                [
                    'order_product_id' => $op->order_product_id,
                    'paymentPrice' => $paymentPrice,
                    'noTaxTotal' => $order_total['noTaxTotal'],
                    'tax' => $order_total['tax'],
                    'total' => $order_total['total']
                ];

        }
        if ($request->has('email')) {
            $ret_array += array('email' => $order->update([
                'email' => $request->input('email')
            ]));
        }
        if ($request->has('telephone')) {
            $ret_array += array('telephone' => $order->update([
                'telephone' => $request->input('telephone')
            ]));
        }
        if ($request->has('fax')) {
            $ret_array += array('fax' => $order->update([
                'fax' => $request->input('fax')
            ]));
        }
        if ($request->has('regNum')) {
            $ret_array += array('regNum' => $order->update([
                'regNum' => $request->input('regNum')
            ]));
        }
        if ($request->has('taxRegNum')) {
            $ret_array += array('taxRegNum' => $order->update([
                'taxRegNum' => $request->input('taxRegNum')
            ]));
        }
        if ($request->has('coupon_id')) {
            $bool = $order->update(['coupon_id' => $request->input('coupon_id')]);
            $order_total = Order_totalService::updateOrInsert($order, null ,0, "coupon");
            $ret_array += array('coupon_id' => $bool,
                'noTaxTotal' => $order_total['noTaxTotal'],
                'tax' => $order_total['tax'],
                'total' => $order_total['total']
                );
        }
        if ($request->has('shipping_gp')) {
            $ret_array += array('shipping_gp' => $order->update([
                'shipping_gp' => $request->input('shipping_gp')
            ]));
        }
        if ($request->has('ip')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('ip' => $order->update([
                'ip' => $request->input('ip')
            ]));
        }
        if ($request->has('reason')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('reason' => $order->update([
                'reason' => $request->input('reason')
            ]));
        }
        if ($request->has('wrong_order_id')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('wrong_order_id' => $order->update([
                'wrong_order_id' => $request->input('wrong_order_id')
            ]));
        }
        if ($request->has('competition')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('competition' => $order->update([
                'competition' => $request->input('competition')
            ]));
        }
        if ($request->has('euVAT')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('euVAT' => $order->update([
                'euVAT' => $request->input('euVAT')
            ]));
        }
        if ($request->has('viewed')) {
            $this->authorize('updateByAdmin', $order);
            $ret_array += array('viewed' => $order->update([
                'viewed' => $request->input('viewed')
            ]));
        }
        if ($request->has('shipping_firstname')) {
            $ret_array += array('shipping_firstname' => $order->update([
                'shipping_firstname' => $request->input('shipping_firstname')
            ]));
        }
        if ($request->has('shipping_lastname')) {
            $ret_array += array('shipping_lastname' => $order->update([
                'shipping_lastname' => $request->input('shipping_lastname')
            ]));
        }
        if ($request->has('shipping_company')) {
            $ret_array += array('shipping_company' => $order->update([
                'shipping_company' => $request->input('shipping_company')
            ]));
        }
        if ($request->has('shipping_address_1')) {
            $ret_array += array('shipping_address_1' => $order->update([
                'shipping_address_1' => $request->input('shipping_address_1')
            ]));
        }
        if ($request->has('shipping_address_2')) {
            $ret_array += array('shipping_address_2' => $order->update([
                'shipping_address_2' => $request->input('shipping_address_2')
            ]));
        }
        if ($request->has('shipping_city')) {
            $ret_array += array('shipping_city' => $order->update([
                'shipping_city' => $request->input('shipping_city')
            ]));
        }
        if ($request->has('shipping_gp')) {
            $ret_array += array('shipping_gp' => $order->update([
                'shipping_gp' => $request->input('shipping_gp')
            ]));
        }
        if ($request->has('shipping_postcode')) {
            $ret_array += array('shipping_postcode' => $order->update([
                'shipping_postcode' => $request->input('shipping_postcode')
            ]));
        }
        if ($request->has('shipping_zone')) {
            $ret_array += array('shipping_zone' => $order->update([
                'shipping_zone' => $request->input('shipping_zone'),
                'shipping_zone_id' => DB::table('oc_zone')
                    ->where('name', $request->input('shipping_zone'))->value('zone_id')
            ]));
        }
        if ($request->has('shipping_country')) {
            $c_id = 0;
            if($request->input('shipping_country') === 'Česká republika') $c_id = 56;
            if($request->input('shipping_country') === 'Slovensko') $c_id = 189;
            $ret_array += array('shipping_country' => $order->update([
                'shipping_country' => $request->input('shipping_country'),
                'shipping_country_id' => $c_id === 0 ? DB::table('oc_country')
                    ->where('name', $request->input('shipping_country'))
                    ->value('country_id') : $c_id
            ]));
        }
        if ($request->has('shipping_address_format')) {
            $ret_array += array('shipping_address_format' => $order->update([
                'shipping_address_format' => $request->input('shipping_address_format')
            ]));
        }
        if ($request->has('payment_firstname')) {
            $ret_array += array('payment_firstname' => $order->update([
                'payment_firstname' => $request->input('payment_firstname')
            ]));
        }
        if ($request->has('payment_lastname')) {
            $ret_array += array('payment_lastname' => $order->update([
                'payment_lastname' => $request->input('payment_lastname')
            ]));
        }
        if ($request->has('payment_company')) {
            $ret_array += array('payment_company' => $order->update([
                'payment_company' => $request->input('payment_company')
            ]));
        }
        if ($request->has('payment_address_1')) {
            $ret_array += array('payment_address_1' => $order->update([
                'payment_address_1' => $request->input('payment_address_1')
            ]));
        }
        if ($request->has('payment_address_2')) {
            $ret_array += array('payment_address_2' => $order->update([
                'payment_address_2' => $request->input('payment_address_2')
            ]));
        }
        if ($request->has('payment_city')) {
            $ret_array += array('payment_city' => $order->update([
                'payment_city' => $request->input('payment_city')
            ]));
        }
        if ($request->has('payment_postcode')) {
            $ret_array += array('payment_postcode' => $order->update([
                'payment_postcode' => $request->input('payment_postcode')
            ]));
        }
        if ($request->has('payment_zone')) {
            $ret_array += array('payment_zone' => $order->update([
                'payment_zone' => $request->input('payment_zone'),
                'payment_zone_id' => DB::table('oc_zone')
                    ->where('name', $request->input('payment_zone'))->value('zone_id')
            ]));
        }
        if ($request->has('payment_country')) {
            $c_id = 0;
            if($request->input('payment_country') === 'Česká republika') $c_id = 56;
            if($request->input('payment_country') === 'Slovensko') $c_id = 189;
            $ret_array += array('payment_country' => $order->update([
                'payment_country' => $request->input('payment_country'),
                'payment_country_id' => $c_id === 0 ? Country
                    ::where('name', $request->input('payment_country'))
                    ->value('country_id') : $c_id
            ]));
        }
        if ($request->has('payment_address_format')) {
            $ret_array += array('payment_address_format' => $order->update([
                'payment_address_format' => $request->input('payment_address_format')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Display addresses of the order.
     * @urlParam order required order id Example: 35022
     *
     * @param Order $order
     * @return Response
     * @throws AuthorizationException
     */
    public function getAddresses(Order $order)
    {
        $this->authorize('accessByAdminOrCustomer', $order);
        return Order::selectAddresses()->getByid($order->order_id);
    }

    /**
     * Make a new invoice.
     * @urlParam order required order id Example: 35202
     *
     * @param Order $order
     * @return Response
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
     * Display all shipping methods with corresponding prices.
     * @urlParam order required order id Example: 35022
     *
     * @param Order $order
     * @return Response
     */
    public function getShipping_methods(Order $order)
    {
        if ($order->shipping_country === 'Česká republika')
            return response()->json(
                [
                    "Česká pošta (Balík Do balíkovny)" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Česká pošta (Balík Do balíkovny)"),
                    "Česká pošta (Balík Do ruky)" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Česká pošta (Balík Do ruky)" ),
                    "Česká pošta (Balík Na poštu)" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Česká pošta (Balík Na poštu)"),
                    "Geis" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Geis"),
                    "Zásilkovna" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Zásilkovna"),
                    "DPD" => OrderService::getTransitOrCODPrice
                    ($order, "base", "DPD")
                ]);

        else if ($order->shipping_country === 'Slovensko')
            return response()->json(
                [
                    "Slovenská pošta" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Slovenská pošta"),
                    "Geis Slovensko" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Geis Slovensko"),
                    "Zásielkovňa" => OrderService::getTransitOrCODPrice
                    ($order, "base", "Zásielkovňa"),
                    "GLS" => OrderService::getTransitOrCODPrice
                    ($order, "base", "GLS")
                ]);
    }


    /**
     * Display all payment methods with corresponding prices.
     * @urlParam order required order id Example: 35022
     *
     * @param Order $order
     * @return Response
     */
    public function getPayment_methods(Order $order)
    {
        return response()->json(
            [
                "Na dobírku" => OrderService::getTransitOrCODPrice
                ($order, "cod", $order->shipping_method),
                "Platba kartou" => 0,
                "Bankovní převod" => 0,
                "Osobní odběr" => 0
            ]);
    }

    /**
     * Display all order statuses.
     *
     * @return array
     */
    public function getOrder_statuses()
    {
        return
            [
                "Nevyřízeno",
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
                "Pouze zásilka"
            ];
    }
}





