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
     * @param Order $order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Order $order)
    {
        return $order->products()->get();
    }

    /**
     * Store a newly created resource in storage.
     * for /order_products
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $product = Product::where('product_id', $request->product_id)->first();
        return Order_product::insertGetId([
            'order_id' => $order->order_id,
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'tax' => $request->input('tax'),
            'quantity' => $request->input('quantity'),
            'sort_order' => $request->input('sort_order'),
            'is_transfer' => $request->input('is_transfer'),
            'is_action' => $request->input('is_action'),
            'gift' => $request->input('gift'),
            'model' => $product->model,
            'price' => $product->price,
            'purchase_price' => $product->purchase_price,
            'warrant' => $product->warranty,
            'total' => $product->price * $request->input('quantity')
        ]);
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
