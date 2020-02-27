<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        return response()->json([
            'shipping_address_1' => $order->shipping_address_1,
            'shipping_address_2' => $order->shipping_address_2,
            'shipping_city' => $order->shipping_city,
            'shipping_postcode' => $order->shipping_postcode,
            'shipping_zone' => $order->shipping_zone,
            'shipping_country' => $order->shipping_country,
        ]);
        //chybí payment adresy
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($order_id, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id, Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($order_id, Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, Order $order)
    {
        //
    }
}
