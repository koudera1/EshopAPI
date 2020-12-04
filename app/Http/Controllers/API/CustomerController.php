<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrder;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @group Customer
 */
class CustomerController extends Controller
{

    /**
     * Display the specified customer.
     *
     * @param Customer $customer
     * @return Response
     */
    public function show(Customer $customer)
    {
        return Customer::join('oc_address', 'oc_address.address_id', '=', 'oc_customer.address_id')
            ->select('firstname', 'lastname', 'email',
                'telephone', 'company', 'address_1',
                'address2', 'postcode', 'city')
            ->where('customer_id', $customer->customer_id)->firstOrFail();
    }

    /**
     * Update the specified customer in storage.
     * @urlParam customer required customer id Example: 1
     *
     * @param UpdateOrder $request
     * @param Customer $customer
     * @return Response
     * @throws AuthorizationException
     * @bodyParam firstname string
     * @bodyParam lastname string
     * @bodyParam company string
     * @bodyParam address_1 string
     * @bodyParam address_2 string
     * @bodyParam city string
     * @bodyParam postcode string
     * @bodyParam zone string
     * @bodyParam country string
     * @bodyParam email string
     * @bodyParam telephone string
     * @bodyParam fax string
     * @bodyParam ip string
     * @bodyParam newsletter integer
     * @bodyParam status integer
     * @bodyParam customer_group_id integer
     * @bodyParam periodSaleTotal float
     * @bodyParam allow_discount integer
     *
     * @response  {
     * "firstname":true,
     * "lastname":true
     * }
     */
    public function update(UpdateOrder $request, Customer $customer)
    {
        $this->authorize('updateByAdminOrAuthenticatedCustomer', $customer);
        $request->validated();
        $ret_array = [];
        $address = "";
        if($customer->address_id === 0)
        {
            $address = Address::create(
                [
                    'customer_id' => $customer->customer_id
                ]
            );
            $customer->update(['address_id' => $address->address_id]);
        } else {
            $address = Address::findOrFail($customer->address_id);
        }
        if ($request->has('company')) {
            $ret_array += array('company' => $address->update([
                'company' => $request->input('company'),
            ]));
        }
        if ($request->has('firstname')) {
            $bool1 = $customer->update([
                'firstname' => $request->input('firstname'),
            ]);
            $bool2 = $address->update([
                'firstname' => $request->input('firstname'),
            ]);
            if($bool1 and $bool2)
                $ret_array += array('firstname' => true);
            else
                $ret_array += array('firstname' => false);
        }
        if ($request->has('lastname')) {
            $bool1 = $customer->update([
                'lastname' => $request->input('lastname'),
            ]);
            $bool2 = $address->update([
                'lastname' => $request->input('lastname'),
            ]);
            if($bool1 and $bool2)
                $ret_array += array('lastname' => true);
            else
                $ret_array += array('lastname' => false);
        }
        if ($request->has('email')) {
            $ret_array += array('email' => $customer->update([
                'email' => $request->input('email'),
            ]));
        }
        if ($request->has('telephone')) {
            $ret_array += array('telephone' => $customer->update([
                'telephone' => $request->input('telephone')
            ]));
        }
        if ($request->has('fax')) {
            $ret_array += array('fax' => $customer->update([
                'fax' => $request->input('fax')
            ]));
        }
        if ($request->has('address_1')) {
            $ret_array += array('address_1' => $address->update([
                'address_1' => $request->input('address_1')
            ]));
        }
        if ($request->has('address_2')) {
            $ret_array += array('address_2' => $address->update([
                'address_2' => $request->input('address_2')
            ]));
        }
        if ($request->has('postcode')) {
            $ret_array += array('postcode' => $address->update([
                'postcode' => $request->input('postcode')
            ]));
        }
        if ($request->has('city')) {
            $ret_array += array('city' => $address->update([
                'city' => $request->input('city')
            ]));
        }
        if ($request->has('zone')) {
            $ret_array += array('zone' => $address->update([
                'zone_id' => DB::table('oc_zone')
                    ->where('name', $request->input('zone'))->value('zone_id')
            ]));
        }
        if ($request->has('country')) {
            $c_id = 0;
            if($request->input('country') === 'Česká republika') $c_id = 56;
            if($request->input('country') === 'Slovensko') $c_id = 189;
            $ret_array += array('country' => $address->update([
                'country_id' => $c_id === 0 ? DB::table('oc_country')
                    ->where('name', $request->input('country'))
                    ->value('country_id') : $c_id
            ]));
        }
        if ($request->has('newsletter')) {
            $ret_array += array('newsletter' => $customer->update([
                'newsletter' => $request->input('newsletter')
            ]));
        }
        if ($request->has('status')) {
            $ret_array += array('status' => $customer->update([
                'status' => $request->input('status')
            ]));
        }
        if ($request->has('customer_group_id')) {
            $ret_array += array('customer_group_id' => $customer->update([
                'customer_group_id' => $request->input('customer_group_id')
            ]));
        }
        if ($request->has('periodSaleTotal')) {
            $ret_array += array('periodSaleTotal' => $customer->update([
                'periodSaleTotal' => $request->input('periodSaleTotal')
            ]));
        }
        if ($request->has('allow_discount')) {
            $ret_array += array('allow_discount' => $customer->update([
                'allow_discount' => $request->input('allow_discount')
            ]));
        }
        if ($request->has('ip')) {
            $ret_array += array('ip' => $customer->update([
                'ip' => $request->input('ip')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param Customer $customer
     * @return Response
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        return response()->json($customer->delete());
    }
}
