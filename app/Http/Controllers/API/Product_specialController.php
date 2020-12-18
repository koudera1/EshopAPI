<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product_special;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Product_special
 */
class Product_specialController extends Controller
{
    /**
     * Display a listing of all special product offers.
     * @urlParam product required product_id
     * @response  {[
     * "product_special_id":470,
     * "product_id":236,
     * "customer_group_id":4,
     * "domain":"www.muj-russellhobbs.cz",
     * "priority":0,
     * "price":599,
     * "date_start":"",
     * "date_end":"2012-01-28 17:00:18",
     * "date_added":"2012-01-28 17:00:18"
     * ]}
     *
     * @param $product_id
     * @return void
     */
    public function index($product_id)
    {
        Product_special::where('product_id', $product_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     * @urlParam product required product_id
     * @bodyParam product_id integer required,
     * @bodyParam customer_group_id integer required
     * @bodyParam domain string required
     * @bodyParam priority integer
     * @bodyParam price integer
     * @bodyParam date_start date
     * @bodyParam date_end date
     * @response  {"product_special_id":470}
     *
     * @param Request $request
     * @param $product_id
     * @return Response
     */
    public function store(Request $request, $product_id)
    {
        $psid = Product_special::insertGetId(
            [
                'product_id' => $product_id,
                'customer_group_id' => $request->input('customer_group_id'),
                'domain' => $request->input('domain'),
                'priority' => $request->input('priority'),
                'price' => $request->input('price'),
                'date_start' => $request->input('date_start', '0000-00-00'),
                'date_end' => $request->input('date_end', '0000-00-00')
            ]
        );

        return response()->json(['product_special_id' => $psid]);
    }

    /**
     * Display the specified resource.
     * @urlParam product required product_id
     * @urlParam product_special required product_special_id
     * @response  {
     * "product_special_id":470,
     * "product_id":236,
     * "customer_group_id":4,
     * "domain":"www.muj-russellhobbs.cz",
     * "priority":0,
     * "price":599,
     * "date_start":"",
     * "date_end":"2012-01-28 17:00:18",
     * "date_added":"2012-01-28 17:00:18"
     * }
     *
     * @param Product_special $product_special
     * @return Response
     */
    public function show(Product_special $product_special)
    {
        return $product_special;
    }

    /**
     * Update the specified resource in storage.
     * @urlParam product required product_id
     * @urlParam product_special required product_special_id
     * @bodyParam product_id integer
     * @bodyParam customer_group_id integer
     * @bodyParam domain string
     * @bodyParam priority integer
     * @bodyParam price integer
     * @bodyParam date_start date
     * @bodyParam date_end date
     * @response  {"domain":true, "price":true}
     *
     * @param Request $request
     * @param Product_special $product_special
     * @return Response
     */
    public function update(Request $request, Product_special $product_special)
    {
        $ret_array = [];
        if ($request->has('product_id')) {
            $ret_array += array('product_id' => $product_special->update([
                'product_id' => $request->input('product_id')
            ]));
        }
        if ($request->has('customer_group_id')) {
            $ret_array += array('customer_group_id' => $product_special->update([
                'customer_group_id' => $request->input('customer_group_id')
            ]));
        }
        if ($request->has('domain')) {
            $ret_array += array('domain' => $product_special->update([
                'domain' => $request->input('domain')
            ]));
        }
        if ($request->has('priority')) {
            $ret_array += array('priority' => $product_special->update([
                'priority' => $request->input('priority')
            ]));
        }
        if ($request->has('price')) {
            $ret_array += array('price' => $product_special->update([
                'price' => $request->input('price')
            ]));
        }
        if ($request->has('date_start')) {
            $ret_array += array('date_start' => $product_special->update([
                'date_start' => $request->input('date_start')
            ]));
        }
        if ($request->has('date_end')) {
            $ret_array += array('date_end' => $product_special->update([
                'date_end' => $request->input('date_end')
            ]));
        }
        return response()->json($ret_array);
    }

    /**
     * Remove the specified resource from storage.
     * @urlParam product required product_id
     * @urlParam product_special required product_special_id
     * @response true
     *
     * @param Product_special $product_special
     * @return Response
     */
    public function destroy(Product_special $product_special)
    {
        return response()->json($product_special);
    }
}
