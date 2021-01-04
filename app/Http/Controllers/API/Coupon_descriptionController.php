<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @group Coupon_description
 */
class Coupon_descriptionController extends Controller
{
    /**
     * Display a listing of all coupon descriptions.
     * @response  {[
     * "coupon_id":1,
     * "language_id":5,
     * "name":"Sleva 15% na výrobky Tangle Teezer",
     * "description":"Sleva 15#% na výrobky Tangle Teezer"
     * ]}
     *
     * @param $coupon_id
     * @return Collection
     * @throws AuthorizationException
     */
    public function index($coupon_id)
    {
        $this->authorize('access', Coupon::class);
        return DB::table('oc_coupon_description')->where('coupon_id', $coupon_id)->get();
    }

    /**
     * Store a newly created coupon description in storage.
     * @urlParam coupon required coupon id Example: 2
     * @bodyParam language_id integer required
     * @bodyParam name string required
     * @bodyParam description string required
     * @response  {
     * "coupon_id":1,
     * "language_id":5
     * }
     *
     * @param Request $request
     * @param $coupon_id
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request, $coupon_id)
    {
        $this->authorize('modify', Coupon::class);
        $bool = DB::table('oc_coupon_description')->insert(
            [
                'product_id' => $coupon_id,
                'language_id' => $request->input('language_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]
        );
        if($bool) return response()->json([
            'coupon_id' => $coupon_id,
            'language_id' => $request->input('language_id')
        ]);
    }

    /**
     * Display the specified coupon description.
     * @urlParam coupon required coupon id Example: 1
     * @urlParam language required language id Example: 5
     * @response  {
     * "coupon_id":1,
     * "language_id":5,
     * "name":"Sleva 15% na výrobky Tangle Teezer",
     * "description":"Sleva 15#% na výrobky Tangle Teezer"
     * }
     *
     * @param $coupon_id
     * @param $language_id
     * @return Response
     */
    public function show($coupon_id, $language_id)
    {
        return DB::table('oc_coupon_description')
            ->where('coupon_id', $coupon_id)
            ->where('language_id', $language_id)
            ->first();
    }


    /**
     * Update the specified coupon description in storage.
     * @urlParam coupon required coupon id Example: 1
     * @urlParam language required language id Example: 5
     * @bodyParam name string
     * @bodyParam description string
     * @response  {
     * "name":true,
     * "description":true
     * }
     *
     * @param Request $request
     * @param $coupon_id
     * @param $language_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, $coupon_id, $language_id)
    {
        $this->authorize('modify', Coupon::class);
        $cd = $this->show($coupon_id, $language_id);
        $ret_array = [];
        if ($request->has('name')) {
            $ret_array += array('name' => $cd->update([
                'name' => $request->input('name')
            ]));
        }
        if ($request->has('description')) {
            $ret_array += array('description' => $cd->update([
                'description' => $request->input('description')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified coupon description from storage.
     * @urlParam coupon required coupon id Example: 1
     * @urlParam language required language id Example: 5
     * @response {true}
     *
     * @param $coupon_id
     * @param $language_id
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy($coupon_id, $language_id)
    {
        $cd = $this->show($coupon_id, $language_id);
        $this->authorize('modify', Coupon::class);
        return response()->json($cd->delete());
    }
}
