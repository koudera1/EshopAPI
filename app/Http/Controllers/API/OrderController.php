<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::leftjoin('oc_order_history','oc_order.order_id','=','oc_order_history.order_id')
            ->leftjoin('oc_order_status','oc_order.order_status_id','=','oc_order_status.order_status_id')
            ->leftjoin('oc_order_product','oc_order.order_id','=','oc_order_product.order_id')
            ->leftjoin('geis_package','oc_order.order_id','=','geis_package.order_id')
            ->leftjoin('postcz_package','oc_order.order_id','=','postcz_package.order_id')
            ->leftjoin('zasilkovna_package','oc_order.order_id','=','zasilkovna_package.order_id')
            ->leftjoin('oc_order_product_move','oc_order.order_id','=','oc_order_product_move.order_id')
            ->select('oc_order.order_id','oc_order.invoice_id','oc_order.domain',
                'oc_order.firstname','oc_order.lastname','oc_order_history.comment',
                'oc_order_status.name as order_status', 'oc_order.shipping_method',
                DB::raw('IF((geis_package.package_order IS NOT NULL) OR (postcz_package.package_order IS NOT NULL)
                 OR (zasilkovna_package.creation_time IS NOT NULL),1,0) as label'),
                'oc_order.date_added','oc_order.total','oc_order.payment_status',
                DB::raw('(oc_order_product.price-oc_order_product.purchase_price)*oc_order_product.quantity as profit'),
                DB::raw('IF(oc_order.payment_country = "Slovensko",1,0) as slovakia'),
                DB::raw('IF(oc_order_product_move.quantity_ext = 0,1,0) as instock'),
                'oc_order.referrer',
                'oc_order.agree_gdpr','oc_order.payment_method','oc_order.email', 'oc_order.telephone')
        ->get();





    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function addresses(Order $order)
    {
        return $order->select('shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_zone',
            'shipping_country', 'payment_address_1', 'payment_address_2', 'payment_city',
            'payment_postcode', 'payment_zone', 'payment_country', 'shipping_address_2')->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function history(Order $order)
    {
        return $order->history;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function products(Order $order)
    {
        return $order->products;
    }
}
