<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Review::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('author'))
            $customer = Customer::find($request->input('customer_id'));
        $rid = Review::insertGetId(
            [
                'product_id' => $request->input('product_id'),
                'customer_id' => $request->input('customer_id'),
                'author' => $request->input('author', $customer->firstname . ' ' . $customer->lastname),
                'text' => $request->input('text'),
                'rating' => $request->input('rating'),
                'status' => $request->input('status')
            ]
        );

        return response()->json(['review_id' => $rid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return $review;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $ret_array = [];
        if ($request->has('author')) {
            $ret_array += array('author' => $review->update([
                'author' => $request->input('author')
            ]));
        }
        if ($request->has('text')) {
            $ret_array += array('text' => $review->update([
                'text' => $request->input('text')
            ]));
        }
        if ($request->has('rating')) {
            $ret_array += array('rating' => $review->update([
                'rating' => $request->input('rating')
            ]));
        }
        return response()->json($ret_array);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        return response()->json($review->delete());
    }
}
