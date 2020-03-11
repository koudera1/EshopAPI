<?php

namespace App\Http\Controllers;

use App\OrderedProduct;
use Illuminate\Http\Request;

class OrderedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * for /orders/{id}/products
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order = null)
    {
        if ($order = null) return null;
        return $order->products();
    }

    /**
     * Store a newly created resource in storage.
     * for /ordered_products
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        OrderedProduct::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderedProduct  $orderedProduct
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(OrderedProduct $orderedProduct, Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderedProduct  $orderedProduct
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderedProduct $orderedProduct, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderedProduct  $orderedProduct
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderedProduct $orderedProduct, Order $order)
    {
        //
    }
}
