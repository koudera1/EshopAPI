<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_history;
use App\Order_product_move;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Order_product_moveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order, Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order, Product $product)
    {
        return Order_product_move::insertGetId([
            'order_id' => $order->order_id,
            'product_id' => $product->product_id,
            'quantity_int' => $request->input('quantity_int'),
            'quantity_ext' => $request->input('quantity_ext')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order_product_move  $order_product_move
     * @return \Illuminate\Http\Response
     */
    public function show(Order_product_move $order_product_move)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_product_move  $order_product_move
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_product_move $order_product_move)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_product_move  $order_product_move
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_product_move $order_product_move)
    {
        //
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getInstock(Order $order, Product $product)
    {
        $move = DB::table('oc_order_product_move')
            ->where('order_id', $order->order_id)
            ->where('product_id', $product->product_id)
            ->first();
        return $move->quantity_int;
    }

    /**
     * Update the specified resource's attribute in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function putInstock(Request $request, Order $order, Product $product)
    {
        $move = DB::table('oc_order_product_move')
            ->where('order_id', $order->order_id)
            >where('product_id', $product->product_id)
            ->first();
        return response()->json($order->update([
            'quantity_int' => $request->input('quantity_int'),
            'quantity_ext' => $request->input('quantity_ext'),
            'date_modified' => date("Y-m-d H:i:s")
        ]));
    }
}
