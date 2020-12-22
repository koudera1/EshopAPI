<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @group Coupon
 */
class CouponController extends Controller
{
    /**
     * Display a listing of all coupons.
     * @response  {[
     * "coupon_id":1,
     * "domain":"www.muj-tangleteezer.cz",
     * "code":"15xtangleteezer",
     * "type":"P",
     * "discount":15.0000,
     * "logged":0,
     * "shipping":1,
     * "total":0.0000,
     * "date_start":"2017-08-01",
     * "date_end":"2027-08-01",
     * "uses_total":9999999,
     * "uses_customer":9999999,
     * "status":1,
     * "date_added":""
     * ]}
     *
     * @return Coupon[]|Collection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('access', Coupon::class);
        return Coupon::all();
    }

    /**
     * Store a newly created coupon in storage.
     * @bodyParam coupon_id integer required
     * @bodyParam domain string required
     * @bodyParam code string required
     * @bodyParam type string required
     * @bodyParam discount float required
     * @bodyParam logged integer required
     * @bodyParam shipping integer required
     * @bodyParam total float required
     * @bodyParam date_start date required
     * @bodyParam date_end date required
     * @bodyParam uses_total integer required
     * @bodyParam uses_customer integer required
     * @bodyParam status integer required
     * @bodyParam date_added date required
     * @bodyParam language_id integer required
     * @bodyParam name string required
     * @bodyParam description string required
     * @response  {
     * "coupon_id":2
     * }
     *
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('modify', Coupon::class);
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
     * Display the specified coupon.
     * @urlParam coupon required coupon id Example: 2
     * @response  {
     * "coupon_id":1,
     * "domain":"www.muj-tangleteezer.cz",
     * "code":"15xtangleteezer",
     * "type":"P",
     * "discount":15.0000,
     * "logged":0,
     * "shipping":1,
     * "total":0.0000,
     * "date_start":"2017-08-01",
     * "date_end":"2027-08-01",
     * "uses_total":9999999,
     * "uses_customer":9999999,
     * "status":1,
     * "date_added":""
     * }
     *
     * @param Coupon $coupon
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Coupon $coupon)
    {
        $this->authorize('access', Coupon::class);
        return $coupon;
    }


    /**
     * Update the specified coupon in storage.
     * @urlParam coupon required coupon id Example: 2
     * @bodyParam domain string
     * @bodyParam code string
     * @bodyParam type string
     * @bodyParam discount float
     * @bodyParam logged integer
     * @bodyParam shipping integer
     * @bodyParam total float
     * @bodyParam date_start date
     * @bodyParam date_end date
     * @bodyParam uses_total integer
     * @bodyParam uses_customer integer
     * @bodyParam status integer
     * @bodyParam name string
     * @bodyParam description string
     * @response  {
     * "code":true,
     * "type":true
     * }
     *
     * @param Request $request
     * @param Coupon $coupon
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Coupon $coupon)
    {
        $this->authorize('modify', Coupon::class);
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
     * Remove the specified coupon from storage.
     * @urlParam coupon required coupon id Example: 2
     * @response {true}
     *
     * @param Coupon $coupon
     * @return Response
     * @throws Exception
     */
    public function destroy(Coupon $coupon)
    {
        $this->authorize('modify', Coupon::class);
        return response()->json($coupon->delete());
    }
}
