<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;

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
        return Order::all();
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
        //
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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function addresses(Order $order)
    {
        return response()->json([
            'shipping_address_1' => $order->shipping_address_1,
            'shipping_address_2' => $order->shipping_address_2,
            'shipping_city' => $order->shipping_city,
            'shipping_postcode' => $order->shipping_postcode,
            'shipping_zone' => $order->shipping_zone,
            'shipping_country' => $order->payment_country,
            'payment_address_1' => $order->payment_address_1,
            'payment_address_2' => $order->payment_address_2,
            'payment_city' => $order->payment_city,
            'payment_postcode' => $order->payment_postcode,
            'payment_zone' => $order->payment_zone,
            'payment_country' => $order->payment_country
        ]);
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
