<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer_group;
use Illuminate\Http\Request;

class Customer_groupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Customer_group::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  \App\Models\Customer_group  $customer_group
     * @return \Illuminate\Http\Response
     */
    public function show(Customer_group $customer_group)
    {
        return $customer_group;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer_group  $customer_group
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\Customer_group  $customer_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer_group $customer_group)
    {
        return response()->json([
            $customer_group->delete()
            ]);
    }
}
