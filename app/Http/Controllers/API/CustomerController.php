<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return Customer::join('oc_address', 'oc_address.address_id', '=', 'oc_customer.address_id')
            ->select('firstname', 'lastname', 'email',
                'telephone', 'company', 'address_1',
                'address2', 'postcode', 'city')
            ->where('customer_id', $customer->customer_id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $request->validated();
        $ret_array = [];
        if ($request->has('shipping_company')) {
            $ret_array += array('shipping_company' => $order->update([
                'shipping_company' => $request->input('shipping_company'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_firstname')) {
            $ret_array += array('shipping_firstname' => $order->update([
                'shipping_firstname' => $request->input('shipping_firstname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_lastname')) {
            $ret_array += array('shipping_lastname' => $order->update([
                'shipping_lastname' => $request->input('shipping_lastname'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_address_1')) {
            $ret_array += array('shipping_address_1' => $order->update([
                'shipping_address_1' => $request->input('shipping_address_1'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_address_2')) {
            $ret_array += array('shipping_address_2' => $order->update([
                'shipping_address_2' => $request->input('shipping_address_2'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
        if ($request->has('shipping_city')) {
            $ret_array += array('shipping_city' => $order->update([
                'shipping_city' => $request->input('shipping_city'),
                'date_modified' => date("Y-m-d H:i:s")
            ]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    }
}
