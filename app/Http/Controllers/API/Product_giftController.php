<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Product_giftController extends Controller
{
    /**
     * Display a listing of all product gifts.
     *
     * @param $product_id
     * @return void
     */
    public function index($product_id)
    {
        DB::table('oc_product_gift')->where('product_id', $product_id)->get();
    }

    /**
     * Store a newly created product gift in storage.
     *
     * @bodyParam quantity integer required
     * @response  {true}
     *
     * @param Request $request
     * @param $product_id

     * @return void
     *
     */
    public function store(Request $request, $product_id)
    {
        return response()->json(DB::table('oc_product_gift')->insert(
            [
                'product_id' => $product_id,
                'gift_id' => $request->input('gift_id'),
                'quantity' => $request->input('quantity')
            ]
        ));
    }

    /**
     * Display the specified product gift.
     *
     * @param $product_id
     * @param $gift_id
     * @return Response
     */
    public function show($product_id, $gift_id)
    {
        return DB::table('oc_product_gift')
            ->where('product_id', $product_id)
            ->where('gift_id', $gift_id)
            ->first();
    }

    /**
     * Update the specified product gift in storage.
     *
     * @bodyParam product_id integer
     * @bodyParam gift_id integer
     * @bodyParam quantity integer
     * @response  {"quantity":false}
     *
     * @param Request $request
     * @param $product_id
     * @param $gift_id
     * @return array
     */
    public function update(Request $request, $product_id, $gift_id)
    {
        $ret_array = [];
        $query = DB::table('oc_product_gift')
            ->where('product_id', $product_id)
            ->where('gift_id', $gift_id);

        if ($request->has('product_id')) {
            $ret_array += array('product_id' => $query->update(
                [
                    'product_id' => $request->input('product_id')
                ]
            ) ? true : false);
        }
        if ($request->has('gift_id')) {
            $ret_array += array('gift_id' => $query->update(
                [
                    'gift_id' => $request->input('gift_id')
                ]
            ) ? true : false);
        }
        if ($request->has('quantity')) {
            $ret_array += array('quantity' => $query->update(
                [
                    'quantity' => $request->input('quantity')
                ]
            ) ? true : false);
        }

        return $ret_array;
    }

    /**
     * Remove the specified product gift from storage.
     *
     * @param $product_id
     * @param $gift_id
     * @return int
     */
    public function destroy($product_id, $gift_id)
    {
        return DB::table('oc_product_gift')
            ->where('product_id', $product_id)
            ->where('gift_id', $gift_id)
            ->delete();
    }
}
