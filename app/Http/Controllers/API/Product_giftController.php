<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_gift;
use Illuminate\Http\Request;

class Product_giftController extends Controller
{
    /**
     * Display a listing of all gift of the product.
     *
     * @param Product $product
     * @return void
     */
    public function index(Product $product)
    {
        Product_gift::where('product_id', $product->product_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_gift  $product_gift
     * @return \Illuminate\Http\Response
     */
    public function show(Product_gift $product_gift)
    {
        return $product_gift;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_gift  $product_gift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_gift $product_gift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_gift  $product_gift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_gift $product_gift)
    {
        //
    }
}
