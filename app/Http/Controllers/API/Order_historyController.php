<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order_history;
use App\Models\Order;
use Illuminate\Http\Request;

class Order_historyController extends Controller
{
    /**
     * Display a listing of order histories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        return Order_history::where('order_id',$order->order_id)->get();
    }

    /**
     * Store a newly created order history in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        return Order_history::insertGetId([
            'order_id' => $order->order_id,
            'order_status_id' => $request->input('order_status_id'),
            'notify' => $request->input('notify'),
            'comment' => $request->input('comment'),
            'date_added' => date("Y-m-d H:i:s")
        ]);
    }

    /**
     * Display the specified order history.
     *
     * @param  \App\Order_history  $order_history
     * @return \Illuminate\Http\Response
     */
    public function show(Order_history $order_history)
    {
        return $order_history;
    }

    /**
     * Update the specified order history in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_history  $order_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_history $order_history)
    {
        //
    }

    /**
     * Remove the specified order history from storage.
     *
     * @param  \App\Order_history  $order_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_history $order_history)
    {
        $order_history->delete();
    }
}
