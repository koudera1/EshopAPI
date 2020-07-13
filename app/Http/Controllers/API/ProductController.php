<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order_product;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Product::insertGetId([
            'category_id' => $request->input('category_id'),
            'category_id2' => $request->input('category_id2'),
            'model' => $request->input('model'),
            'sku' => $request->input('sku'),
            'location' => $request->input('location',''),
            'quantity' => $request->input('quantity',0),
            'internal_quantity' => $request->input('internal_quantity',0),
            'stock_status_id' => $request->input('stock_status_id'),
            'image' => $request->input('image'),
            'manufacturer_id' => $request->input('manufacturer_id'),
            'shipping' => $request->input('shipping',1),
            'price' => $request->input('price',0.0000),
            'tax_class_id' => $request->input('tax_class_id'),
            'date_available' => $request->input('date_available'),
            'weight' => $request->input('weight',0.00),
            'weight_class_id' => $request->input('weight_class_id',0),
            'length' => $request->input('length',0.00),
            'width' => $request->input('width',0.00),
            'height' => $request->input('height',0.00),
            'measurement_class_id' => $request->input('measurement_class_id',0),
            'status' => $request->input('status',0),
            'date_added' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'viewed' => $request->input('viewed',0),
            'container_capacity' => $request->input('container_capacity'),
            'req_container' => $request->input('req_container',0),
            'purchase_price' => $request->input('purchase_price',0.0000),
            'viewed_month' => $request->input('viewed_month',0),
            'viewed_quartal' => $request->input('viewed_quartal',0),
            'viewed_year' => $request->input('viewed_year',0),
            'heureka' => $request->input('heureka',''),
            'heureka_cat' => $request->input('heureka_cat',''),
            'heureka_name' => $request->input('heureka_name',''),
            'warranty' => $request->input('warranty',24),
            'sold_quartal' => $request->input('sold_quartal'),
            'conversion_quartal' => $request->input('conversion_quartal'),
            'free_shipping' => $request->input('free_shipping',0),
            'domains' => $request->input('domains'),
            'color1' => $request->input('color1'),
            'color2' => $request->input('color2'),
            'color3' => $request->input('color3'),
            'marketing_domain' => $request->input('marketing_domain'),
            'raw_name' => $request->input('raw_name'),
            'zasilkovna_enabled' => $request->input('zasilkovna_enabled',1),
            'condition' => $request->input('condition',1),
            'erotic' => $request->input('erotic',0)
        ]);
        $language_id = DB::table('oc_language')
            ->where('name',$request->input('language'))
            ->value('language_id');

        DB::table('oc_product_description')->insert([
            'product_id' => $id,
            'language_id' => $language_id,
            'name' => $request->input('name'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'),
            'description' => $request->input('description'),
            'intro' => $request->input('intro')
        ]);

        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
