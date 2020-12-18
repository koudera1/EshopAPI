<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer_group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

/**
 * @group Customer_group
 */
class Customer_groupController extends Controller
{
    /**
     * Display a listing of all customer groups.
     * @response  {[
     * "customer_group_id":2,
     * "name":"sleva5procent"
     * ]}
     *
     * @return Customer_group[]|Collection
     */
    public function index()
    {
        return Customer_group::all();
    }

    /**
     * Store a newly created customer group in storage.
     * @bodyParam name string required
     * @response  {
     * "customer_group_id":2,
     * }
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $cgid = Customer_group::insertGetId(
            [
                'name' => $request->input('name')
            ]
        );
        return response()->json(['customer_group_id' => $cgid]);
    }

    /**
     * Display the specified customer group.
     * @urlParam customer group required customer group id Example: 2
     * @response  {
     * "customer_group_id":2,
     * "name":"sleva5procent"
     * }
     *
     * @param Customer_group $customer_group
     * @return Customer_group
     */
    public function show(Customer_group $customer_group)
    {
        return $customer_group;
    }

    /**
     * Update the specified customer group in storage.
     * @urlParam customer group required customer group id Example: 2
     * @bodyParam name string
     *
     * @param Request $request
     * @param Customer_group $customer_group
     * @return Response
     */
    public function update(Request $request, Customer_group $customer_group)
    {
        $ret_array = [];
        if ($request->has('name')) {
            $ret_array += array('name' => $customer_group->update([
                'name' => $request->input('name')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer_group $customer_group
     * @return Response
     * @throws Exception
     */
    public function destroy(Customer_group $customer_group)
    {
        return response()->json([
            $customer_group->delete()
            ]);
    }
}
