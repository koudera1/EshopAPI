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
     * Display a listing of ordered products.
     *
     * @param Order $order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Order $order)
    {
        return $order->products()->get();
    }

    /**
     * Store a newly created ordered product in storage.
     * @bodyParam product_id
     * @bodyParam name
     * @bodyParam tax
     * @bodyParam quantity
     * @bodyParam sort_order
     * @bodyParam is_transfer
     * @bodyParam is_action
     * @bodyParam gift
     * @bodyParam quantity
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
     * Display the specified ordered product.
     * @param  \App\Order_product  $order_product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order_product $order_product)
    {
        return $order_product;
    }

    /**
     * Update the specified ordered product in storage.
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
     * Remove the specified ordered product from storage.
     *
     * @param  \App\Order_product  $order_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_product $order_product)
    {
        $order_product->delete();
    }
}
