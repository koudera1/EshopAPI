<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order_total;
use Illuminate\Http\Request;

class Order_totalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        Order_total::where('order_id',$order->order_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Order $order, Request $request)
    {
        return Order_total::insertGetId(
            [
                'order_id' => $order->order_id,
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'value' => $request->input('value'),
                'sort_order' => $request->input('sort_order')
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order_total  $order_total
     * @return \Illuminate\Http\Response
     */
    public function show(Order_total $order_total)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_total  $order_total
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_total $order_total)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_total  $order_total
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_total $order_total)
    {
        //
    }
}
