<?php

namespace App\Http\Controllers\API;

use App\Models\Geis_delivery;
use App\Models\Geis_numbering;
use App\Http\Controllers\Controller;
use App\Models\Geis_package;
use App\Models\Order;
use App\Models\Postcz_delivery;
use App\Models\Postcz_numbering;
use App\Models\Postcz_package;
use App\Models\Product;
use App\Models\Zasilkovna_package;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use SoapClient;
use SoapFault;


/**
 * @group Package
 */
class PackageController extends Controller
{
    /**
     * Display a listing of all packages.
     * @urlParam order required order id Example: 35022
     *
     * @param Order $order
     * @return Collection
     */
    public function index(Order $order)
    {
       if($order->shipping_method == "Geis")
            return Geis_package::join('geis_delivery', 'geis_package.order_id', '=', 'geis_delivery.order_id')
                ->where('geis_package.order_id', $order->order_id)->get();
        elseif (mb_substr($order->shipping_method, 0, 11) === "Česká pošta")
            return Postcz_package::join('postcz_delivery', 'postcz_package.order_id', '=', 'postcz_delivery.order_id')
                ->where('postcz_delivery.order_i', $order->order_id)->get();
        else
            return Zasilkovna_package::where('order_id', $order->order_id)->get();
    }

    /**
     * Store a newly created package and delivery in storage.
     * Geis - cod, b2c, routing_id, phone, driver_note, recipient_note, source, gar, package_order
     * | Postcz - source, cod, commercial, service, phone, package_order, weight
     * | Zásilkovna - cod, weight
     *
     * @urlParam order required order id Example: 35022
     * @bodyParam cod float required Whether it has cash on delivery for the customer to pay.
     * @bodyParam b2c integer
     * @bodyParam routing_id integer
     * @bodyParam phone string
     * @bodyParam driver_note string
     * @bodyParam recipient_note string
     * @bodyParam source integer
     * @bodyParam gar integer
     * @bodyParam package_order integer
     * @bodyParam commercial integer
     * @bodyParam service string
     * @bodyParam weight float The weight of the package.
     * @response {"delivery_id":8092812000, "package_id":8092812000}
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     * @throws SoapFault
     * @throws AuthorizationException
     */
    public function store(Request $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $date = date("Y-m-d H:i:s");
        if ($order->shipping_method == "Geis") {
            $delivery_id =  Geis_numbering::select('min')->where('is_free', 1)->firstOrFail();
            Geis_numbering::where('is_free', 0)->update(['max' => $delivery_id['min']]);
            Geis_numbering::where('is_free', 1)->update(['min' => ($delivery_id['min'] + 1)]);
            $bool1 = Geis_delivery::insert(
                [
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'cod' => $request->input('cod'),
                    'b2c' => $request->input('b2c'),
                    'packages' => 1,
                    'routing_id' => $request->input('routing_id'),
                    'phone' => $request->input('phone'),
                    'driver_note' => $request->input('driver_note'),
                    'recipient_note' => $request->input('recipient_note'),
                    'source' => $request->input('source'),
                    'gar' => $request->input('gar')
                ]
            );

            $bool2 = Geis_package::insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order')
                ]
            );

            return response()->json(
                [
                    'delivery_id' => $bool1 and $bool2 ? $delivery_id['min'] : null,
                    'package_id' => $bool1 and $bool2 ? $delivery_id['min'] : null
                ]
            );

        } else if (mb_substr($order->shipping_method, 0, 11) === "Česká pošta") {
            $delivery_id = Postcz_numbering::select('min')->where('is_free', 1)
                ->where('source',$request->input('source'))->firstOrFail();
            if($delivery_id === null) return response()->json(false);
            Postcz_numbering::where('is_free', 0)
                ->where('source',$request->input('source'))
                ->update(['max' => $delivery_id['min']]);
            Postcz_numbering::where('is_free', 1)
                ->where('source',$request->input('source'))
                ->update(['min' => ($delivery_id['min'] + 1)]);
            $bool1 =Postcz_delivery::insert(
                [
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'cod' => $request->input('cod'),
                    'commercial' => $request->input('commercial'),
                    'service' => $request->input('service'),
                    'packages' => 1,
                    'phone' => $request->input('phone'),
                    'source' => $request->input('source'),
                    'last_status' => "Zatím nezjištěn"
                ]
            );

            $bool2 = Postcz_package::insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order'),
                    'weight' => $request->input('weight')
                ]
            );

            return response()->json(
                [
                    'delivery_id' => ($bool1 and $bool2) ? $delivery_id['min'] : null,
                    'package_id' => ($bool1 and $bool2) ? $delivery_id['min'] : null
                ]
            );

        } else {

            $gw = new SoapClient("https://www.zasilkovna.cz/api/soap-php-bugfix.wsdl");
            $apiPassword = "2bb8a76f0b6cd8b061eef2ec4340e3e7";

            $country_id = $order->shipping_country_id;
            if ($country_id == 170) { // polsko
                $addressId = 272; // polská pošta
            } elseif ($order->shipping_gp != '') {
                $addressId = $order->shipping_gp;
            } else { // use postcode
                if (in_array(substr($order->shipping_postcode, 0, 1), ['0', '8', '9'])) {
                    if ($order->shipping_method == 'GLS') {
                        $addressId = 149; // sk? - slovensko kurýr
                    } else {
                        $addressId = 16; // sk? - slovenská pošta
                    }
                } elseif ($order->shipping_method == 'DPD') {
                    $addressId = 633; // cz? - česká republika dpd
                } else {
                    $addressId = 13; // cz? - česká pošta
                }
            }

            $address = explode(" ", $order->shipping_address_1);

            try {
                $packetAttributes =
                    [
                        'number' => $order->order_id,
                        'name' => $order->firstname,
                        'surname' => $order->lastname,
                        'email' => $order->email,
                        'phone' => $order->telephone,
                        'addressId' => $addressId,
                        'currency' => $order->currency,
                        'cod' => $request->input('cod'),
                        'value' => $order->total * $order->value,
                        'weight' => $request->input('weight'),
                        'eshop' => $order->domain,
                        'street' => $address[0],
                        'houseNumber' => $address[1],
                        'city' => $order->shipping_city,
                        'zip' => $order->shipping_postcode
                    ];
                $packet = $gw->createPacket($apiPassword, $packetAttributes);
                } catch (SoapFault $e) {
                    return new \Exception($e->getMessage()); // property detail contains error info
                }

                $bool = Zasilkovna_package::insert(
                        [
                            'package_id' => $packet->id,
                            'order_id' => $order->order_id,
                            'creation_time' => $date,
                            'PacketAttributes' => json_encode($packetAttributes),
                            'PacketIdDetail' => json_encode($packet),
                            'active' => 1
                        ]);

                return response()->json(['package_id' => $bool ? $packet->id : null]);
        }

        abort('404');
    }

    /**
     * Display the specified package and delivery.
     * @urlParam order required order id Example: 35022
     * @urlParam package required package id Example: 35022
     *
     * @param Order $order
     * @return Collection
     */
    public function show(Order $order, $package_id)
    {
        if($order->shipping_method == "Geis")
            return Geis_package::join('geis_delivery', 'geis_package.order_id', '=', 'geis_delivery.order_id')
                ->where('geis_package.order_id', $order->order_id)
                ->where('geis_package.package_id', $package_id)
                ->first();
        elseif (mb_substr($order->shipping_method, 0, 11) === "Česká pošta")
            return Postcz_package::join('postcz_delivery', 'postcz_package.order_id', '=', 'postcz_delivery.order_id')
                ->where('postcz_package.order_i', $order->order_id)
                ->where('postcz_package.package_id', $package_id)
                ->first();
        else
            return Zasilkovna_package
                ::where('order_id', $order->order_id)
                ->where('package_id', $package_id)
                ->get();
    }

    /**
     * Update the specified package and delivery.
     * Geis - cod, b2c, routing_id, phone, driver_note, recipient_note, source, gar, package_order,
     * protocol_id, last_status
     * | Postcz - source, cod, commercial, service, phone, package_order, weight, protocol_id, last_status
     * | Zásilkovna - active, protocol_id, last_status
     * @urlParam order required order id Example: 35022
     * @urlParam package required package id
     * @bodyParam last_status string
     * @bodyParam protocol_id integer
     * @bodyParam cod float required Whether it has cash on delivery for the customer to pay.
     * @bodyParam b2c integer
     * @bodyParam routing_id integer
     * @bodyParam phone string
     * @bodyParam driver_note string
     * @bodyParam recipient_note string
     * @bodyParam source integer
     * @bodyParam gar integer
     * @bodyParam package_order integer
     * @bodyParam commercial integer
     * @bodyParam service string
     * @bodyParam weight float The weight of the package.
     * @bodyParam active integer
     * @response  {"cod":true, "b2c":true}
     *
     * @param Request $request
     * @param Order $order
     * @param $package_id
     * @return Collection
     * @throws AuthorizationException
     */
    public function update(Request $request, Order $order, $package_id)
    {
        $this->authorize('modify', Order::class);
        $ret_array = [];
        if ($order->shipping_method == "Geis") {
            $package = Geis_package::find($package_id);
            $delivery = Geis_delivery::find($package_id);
            if ($request->has('package_order')) {
                $ret_array += array('package_order' => $package->update([
                    'package_order' => $request->input('package_order')
                ]));
            }
            if ($request->has('protocol_id')) {
                $ret_array += array('protocol_id' => $package->update([
                    'protocol_id' => $request->input('protocol_id')
                ]));
                $ret_array += array('protocol_id' => $delivery->update([
                    'protocol_id' => $request->input('protocol_id')
                ]));
            }
            if ($request->has('cod')) {
                $ret_array += array('cod' => $delivery->update([
                    'cod' => $request->input('cod')
                ]));
            }
            if ($request->has('b2c')) {
                $ret_array += array('b2c' => $delivery->update([
                    'b2c' => $request->input('b2c')
                ]));
            }
            if ($request->has('routing_id')) {
                $ret_array += array('routing_id' => $delivery->update([
                    'routing_id' => $request->input('routing_id')
                ]));
            }
            if ($request->has('phone')) {
                $ret_array += array('phone' => $delivery->update([
                    'phone' => $request->input('phone')
                ]));
            }
            if ($request->has('driver_note')) {
                $ret_array += array('driver_note' => $delivery->update([
                    'driver_note' => $request->input('driver_note')
                ]));
            }
            if ($request->has('recipient_note')) {
                $ret_array += array('recipient_note' => $delivery->update([
                    'recipient_note' => $request->input('recipient_note')
                ]));
            }
            if ($request->has('source')) {
                $ret_array += array('source' => $delivery->update([
                    'source' => $request->input('source')
                ]));
            }
            if ($request->has('gar')) {
                $ret_array += array('gar' => $delivery->update([
                    'gar' => $request->input('gar')
                ]));
            }
            return response()->json($ret_array);
        } else if (mb_substr($order->shipping_method, 0, 11) === "Česká pošta") {
            $package = Postcz_package::find($package_id);
            $delivery = Postcz_delivery::find($package_id);
            if ($request->has('protocol_id')) {
                $ret_array += array('protocol_id' => $package->update([
                    'protocol_id' => $request->input('protocol_id')
                ]));
                $ret_array += array('protocol_id' => $delivery->update([
                    'protocol_id' => $request->input('protocol_id')
                ]));
            }
            if ($request->has('weight')) {
                $ret_array += array('weight' => $package->update([
                    'weight' => $request->input('weight')
                ]));
            }
            if ($request->has('package_order')) {
                $ret_array += array('product_id' => $package->update([
                    'package_order' => $request->input('package_order')
                ]));
            }
            if ($request->has('cod')) {
                $ret_array += array('cod' => $delivery->update([
                    'cod' => $request->input('cod')
                ]));
            }
            if ($request->has('commercial')) {
                $ret_array += array('commercial' => $delivery->update([
                    'commercial' => $request->input('commercial')
                ]));
            }
            if ($request->has('service')) {
                $ret_array += array('service' => $delivery->update([
                    'service' => $request->input('service')
                ]));
            }
            if ($request->has('phone')) {
                $ret_array += array('phone' => $delivery->update([
                    'phone' => $request->input('phone')
                ]));
            }
            if ($request->has('source')) {
                $ret_array += array('source' => $delivery->update([
                    'source' => $request->input('source')
                ]));
            }
            if ($request->has('last_status')) {
                $ret_array += array('last_status' => $delivery->update([
                    'last_status' => $request->input('last_status')
                ]));
            }
            return response()->json($ret_array);
        } else {
            $package = Zasilkovna_package::find($package_id);
            if ($request->has('protocol_id')) {
                $ret_array += array('protocol_id' => $package->update([
                    'protocol_id' => $request->input('protocol_id')
                ]));
            }
            if ($request->has('active')) {
                $ret_array += array('weight' => $package->update([
                    'weight' => $request->input('weight')
                ]));
            }
            if ($request->has('last_status')) {
                $ret_array += array('last_status' => $package->update([
                    'last_status' => $request->input('last_status')
                ]));
            }
        }
    }


}
