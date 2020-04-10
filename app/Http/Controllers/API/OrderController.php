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
                'oc_order.referrer', 'oc_order.agree_gdpr','oc_order.payment_method','oc_order.email', 'oc_order.telephone')
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
        $id = $order->order_id;
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
                DB::raw('IF(oc_order.shipping_country = "Slovensko",1,0) as slovakia'),
                DB::raw('IF(oc_order_product_move.quantity_ext = 0,1,0) as instock'),
                'oc_order.referrer', 'oc_order.agree_gdpr','oc_order.payment_method','oc_order.email', 'oc_order.telephone')
            ->where('oc_order.order_id', $id)
            ->first();
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
     * Update the specified resource's attribute in storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function history(Order $order)
    {
        return $order->history;
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function domain(Request $request, Order $order)
    {
        $order->domain = $request->input('domain');
        $order->date_modified = date("Y-m-d H:i:s");
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function firstname(Request $request, Order $order)
    {
        $order->firstname = $request->input('firstname');
        $order->date_modified = date("Y-m-d H:i:s");
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function lastname(Request $request, Order $order)
    {
        $order->lastname = $request->input('lastname');
        $order->date_modified = date("Y-m-d H:i:s");
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $id = $order->order_id;
        $history = OrderHistory::where('order_id',$id);
        $history->comment = $request->input('comment');
        $history->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_status(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $id = $order->order_status_id;
        $status = DB::table('oc_order_status')
            ->where('order_status_id', $id);
        $status->name = $request->input('order_status');
        $status->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function shipping_method(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->shipping_method = $request->input('shipping_method');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function total(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->total = $request->input('total');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function payment_status(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->payment_status = $request->input('payment_status');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function slovakia(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        if($order->slovakia == 0) $order->shipping_country = "Česká republika";
        else $order->shipping_country = "Slovensko";
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function instock(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $move = DB::table('oc_order_product_move')
            ->where('order_id',$order->order_id);
        $move->quantity_int = $request->input('quantity_int');
        $move->quantity_ext = $request->input('quantity_ext');
        $move->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function referrer(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->referrer = $request->input('referrer');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function agree_gdpr(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->agree_gdpr = $request->input('agree_gdpr');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function payment_method(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->payment_method = $request->input('payment_method');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function email(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->email = $request->input('email');
        $order->save();
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function telephone(Request $request, Order $order)
    {
        $order->date_modified = date("Y-m-d H:i:s");
        $order->telephone = $request->input('telephone');
        $order->save();
    }




}
