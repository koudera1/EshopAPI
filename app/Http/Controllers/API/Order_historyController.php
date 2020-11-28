<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order_history;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Order_historyController extends Controller
{
    /**
     * Display a listing of order histories.
     *
     * @param Order $order
     * @return Response
     */
    public function index(Order $order)
    {
        return Order_history::where('order_id',$order->order_id)->get();
    }

    /**
     * Store a newly created order history in storage
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->firstOrFail();
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
     * @param Order_history $order_history
     * @return Order_history
     */
    public function show(Order_history $order_history)
    {
        return $order_history;
    }


    /**
     * Remove the specified order history from storage.
     *
     * @param Order_history $order_history
     * @return Response
     * @throws Exception
     */
    public function destroy(Order_history $order_history)
    {
        return response()->json($order_history->delete());
    }
}
