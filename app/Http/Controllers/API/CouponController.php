<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Coupon::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cid = Coupon::insertGetId(
            [
                'domain' => $request->input('domain'),
                'code' => $request->input('code'),
                'type' => $request->input('type'),
                'discount' => $request->input('discount'),
                'logged' => $request->input('logged'),
                'total' => $request->input('total'),
                'date_start' => $request->input('date_start'),
                'date_end' => $request->input('date_end'),
                'uses_total' => $request->input('uses_total'),
                'uses_customer' => $request->input('uses_customer'),
                'status' => $request->input('status')
            ]
        );

        $bool = DB::table('oc_coupon_description')->insert([
            'coupon_id' => $cid,
            'language_id' => $request->input('language_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        if($bool) return response()->json(['coupon_id' => $cid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return $coupon;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $ret_array = [];
        if ($request->has('domain')) {
            $ret_array += array('domain' => $coupon->update([
                'domain' => $request->input('domain')
            ]));
        }
        if ($request->has('code')) {
            $ret_array += array('code' => $coupon->update([
                'code' => $request->input('code')
            ]));
        }
        if ($request->has('type')) {
            $ret_array += array('type' => $coupon->update([
                'type' => $request->input('type')
            ]));
        }
        if ($request->has('discount')) {
            $ret_array += array('discount' => $coupon->update([
                'discount' => $request->input('discount')
            ]));
        }
        if ($request->has('logged')) {
            $ret_array += array('logged' => $coupon->update([
                'logged' => $request->input('logged')
            ]));
        }
        if ($request->has('shipping')) {
            $ret_array += array('shipping' => $coupon->update([
                'shipping' => $request->input('shipping')
            ]));
        }
        if ($request->has('total')) {
            $ret_array += array('total' => $coupon->update([
                'total' => $request->input('total')
            ]));
        }
        if ($request->has('date_start')) {
            $ret_array += array('date_start' => $coupon->update([
                'date_start' => $request->input('date_start')
            ]));
        }
        if ($request->has('date_end')) {
            $ret_array += array('date_end' => $coupon->update([
                'date_end' => $request->input('date_end')
            ]));
        }
        if ($request->has('uses_total')) {
            $ret_array += array('uses_total' => $coupon->update([
                'uses_total' => $request->input('uses_total')
            ]));
        }
        if ($request->has('uses_customer')) {
            $ret_array += array('uses_customer' => $coupon->update([
                'uses_customer' => $request->input('uses_customer')
            ]));
        }
        if ($request->has('status')) {
            $ret_array += array('status' => $coupon->update([
                'status' => $request->input('status')
            ]));
        }
        if ($request->has('name')) {
            $ocd = DB::table('oc_coupon_description')->find($coupon->coupon_id);
            $ret_array += array('name' => $ocd->update([
                'name' => $request->input('name')
            ]));
        }
        if ($request->has('description')) {
            $ocd = DB::table('oc_coupon_description')->find($coupon->coupon_id);
            $ret_array += array('description' => $ocd->update([
                'description' => $request->input('description')
            ]));
        }
        return response()->json($ret_array);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        return response()->json($coupon->delete());
    }
}
