<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order_product;
use App\Order;
use App\Product;

use Illuminate\Http\Request;

class Order_productController extends Controller
{
    /**
     * Display a listing of the resource.
     * for /orders/{id}/products
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        return $order->products()->get();
    }

    /**
     * Store a newly created resource in storage.
     * for /order_products
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ord_products = new OrderedProduct();
        $ord_products->order_id = $request->input('order_id');
        $ord_products->product_id = $request->input('product_id');
        $ord_products->name = $request->input('name');
        $ord_products->tax = $request->input('tax');
        $ord_products->quantity = $request->input('quantity');
        $ord_products->sort_order = $request->input('sort_order');
        $ord_products->is_transfer = $request->input('is_transfer');
        $ord_products->is_action = $request->input('is_action');
        $ord_products->gift = $request->input('gift');

        $product = Product::where('product_id', $request->product_id)->first();

        $ord_products->model = $product->model;
        $ord_products->price = $product->price;
        $ord_products->purchase_price = $product->purchase_price;
        $ord_products->warranty = $product->warranty;
        $ord_products->total = $product->price * $ord_products->quantity;

        $ord_products->save();

        return response()->json($ord_products);
    }

    /**
     * Display the specified resource.
     * @param  \App\Order_product  $order_product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order_product $order_product)
    {
        return $order_product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_product  $order_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_product $order_product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_product  $order_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_product $order_product)
    {
        $order_product->delete();
    }
}
