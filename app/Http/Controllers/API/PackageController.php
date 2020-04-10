<?php

namespace App\Http\Controllers\API;

use App\Geis_numbering;
use App\Http\Controllers\Controller;
use App\Order;
use App\Postcz_numbering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SoapClient;
use SoapFault;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
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
            return DB::table('zasilkovna_package')->where('order_id', $order->order_id)->get();*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $date = date("Y-m-d H:i:s");
        if ($order->shipping_method == "Geis") {
            $delivery_id =  Geis_numbering::select('min')->where('is_free', 1)->first();
            Geis_numbering::where('is_free', '=', 0)->update(['max' => $delivery_id['min']]);
            Geis_numbering::where('is_free', 1)->update(['min' => ($delivery_id['min'] + 1)]);
            DB::table('geis_delivery')->insert(
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

            DB::table('geis_package')->insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order')
                ]
            );
        } else if (mb_substr($order->shipping_method, 0, 11) === "Česká pošta") {
            $delivery_id = Postcz_numbering::select('min')->where('is_free', 1)
                ->where('source',$request->input('source'))->first();
            Postcz_numbering::where('is_free', 0)
                ->where('source',$request->input('source'))
                ->update(['max' => $delivery_id['min']]);
            Postcz_numbering::where('is_free', 1)
                ->where('source',$request->input('source'))
                ->update(['min' => ($delivery_id['min'] + 1)]);
            DB::table('postcz_delivery')->insert(
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

            DB::table('postcz_package')->insert(
                [
                    'package_id' => $delivery_id['min'],
                    'delivery_id' => $delivery_id['min'],
                    'order_id' => $order->order_id,
                    'creation_time' => $date,
                    'package_order' => $request->input('package_order'),
                    'weight' => $request->input('weight')
                ]
            );
        } else {

            $gw = new SoapClient("https://www.zasilkovna.cz/api/soap-php-bugfix.wsdl");
            $apiPassword = "xxx";

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

                DB::table('zasilkovna_package')->insert(
                    [
                        'package_id' => $packet->id,
                        'order_id' => $order->order_id,
                        'creation_time' => $date,
                        'PacketAttributes' => json_encode($packetAttributes),
                        'PacketIdDetail' => json_encode($packet),
                        'active' => 1
                    ]
                );


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
