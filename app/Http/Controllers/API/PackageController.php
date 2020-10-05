<?php

namespace App\Http\Controllers\API;

use App\Models\Geis_numbering;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Postcz_numbering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SoapClient;
use SoapFault;


/**
 * @group Package
 */
class PackageController extends Controller
{
    /**
     * Display a listing of packages.
     * @urlParam order required order id Example: 35022
     *
     * @param  \Illuminate\Http\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
       if($order->shipping_method == "Geis")
            return DB::table('geis_package')->where('order_id', $order->order_id)->get();
        elseif (mb_substr($order->shipping_method, 0, 11) === "Česká pošta")
            return DB::table('postcz_package')->where('order_id', $order->order_id)->get();
        else
            return DB::table('zasilkovna_package')->where('order_id', $order->order_id)->get();
    }

    /**
     * Store a newly created package in storage.
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
     * @response true
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Order $order
     * @return \Illuminate\Http\Response
     * @throws SoapFault
     */
    public function store(Request $request, Order $order)
    {
        $date = date("Y-m-d H:i:s");
        if ($order->shipping_method == "Geis") {
            $delivery_id =  Geis_numbering::select('min')->where('is_free', 1)->first();
            Geis_numbering::where('is_free', 0)->update(['max' => $delivery_id['min']]);
            Geis_numbering::where('is_free', 1)->update(['min' => ($delivery_id['min'] + 1)]);
            $bool1 = DB::table('geis_delivery')->insert(
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

            $bool2 = DB::table('geis_package')->insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order')
                ]
            );

            if ($bool1 and $bool2)
                return response()->json(true);
            else
                return response()->json(false);
        } else if (mb_substr($order->shipping_method, 0, 11) === "Česká pošta") {
            $delivery_id = Postcz_numbering::select('min')->where('is_free', 1)
                ->where('source',$request->input('source'))->first();
            if($delivery_id === null) return response()->json(false);
            Postcz_numbering::where('is_free', 0)
                ->where('source',$request->input('source'))
                ->update(['max' => $delivery_id['min']]);
            Postcz_numbering::where('is_free', 1)
                ->where('source',$request->input('source'))
                ->update(['min' => ($delivery_id['min'] + 1)]);
            $bool1 = DB::table('postcz_delivery')->insert(
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

            $bool2 = DB::table('postcz_package')->insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order'),
                    'weight' => $request->input('weight')
                ]
            );

            if ($bool1 and $bool2)
                return response()->json(true);
            else
                return response()->json(false);
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
                    dd($e->detail); // property detail contains error info
                }

                return response()->json(DB::table('zasilkovna_package')->insert(
                    [
                        'package_id' => $packet->id,
                        'order_id' => $order->order_id,
                        'creation_time' => $date,
                        'PacketAttributes' => json_encode($packetAttributes),
                        'PacketIdDetail' => json_encode($packet),
                        'active' => 1
                    ]
                ));
        }
    }

    /**
     * Update the specified package in storage.
     * @urlParam order required order id Example: 35022
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, $package_id)
    {
        //
    }

    /**
     * Remove the specified package from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($package_id)
    {

    }
}
