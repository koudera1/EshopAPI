<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_history;
use App\Models\Order_product_move;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Order_product_moveService extends Controller
{
    /**
     * Get how many products are in stock.
     *
     * @param Order $order
     * @param Product $product
     * @return Response
     */
    public function getInstock(Order $order, Product $product)
    {
        $move = DB::table('oc_order_product_move')
            ->where('order_id', $order->order_id)
            ->where('product_id', $product->product_id)
            ->firstOrFail();
        return $move->quantity_int;
    }

    /**
     * Update Get how many products are in stock.
     *
     * @param Request $request
     * @param Order $order
     * @param Product $product
     * @return Response
     */
    public function putInstock(Request $request, Order $order, Product $product)
    {
        $move = DB::table('oc_order_product_move')
            ->where('order_id', $order->order_id)
            >where('product_id', $product->product_id)
            ->firstOrFail();
        return response()->json($order->update([
            'quantity_int' => $request->input('quantity_int'),
            'quantity_ext' => $request->input('quantity_ext'),
            'date_modified' => date("Y-m-d H:i:s")
        ]));
    }

    /**
     * Update quantity of products in stock.
     *
     * @param Order $order
     * @param Product $product
     * @param $originalQuantity
     * @return bool
     */
    public static function updateStock(Order $order, Product $product, $originalQuantity)
    {
        $quantity = $product->internal_quantity - $originalQuantity;
        if($quantity <= 0)
        {

            $bool2 = Order_product_move::insert([
                'order_id' => $order->order_id,
                'product_id' => $product->product_id,
                'quantity_int' => $product->internal_quantity,
                'quantity_ext' => - $quantity
            ]);
            $bool1 = $product->update(
                [
                    'quantity' => $product->quantity + $quantity,
                    'internal_quantity'=> 0
                ]);
        } else {
            $bool2 = Order_product_move::insert([
                'order_id' => $order->order_id,
                'product_id' => $product->product_id,
                'quantity_int' => $originalQuantity,
                'quantity_ext' => 0
            ]);
            $bool1 = $product->update(
                [
                    'internal_quantity'=> $quantity
                ]);
        }
        if($bool1 and $bool2) return true;
        else return false;
    }

    /**
     * Lower quantity of products in stock.
     *
     * @param Product $product
     * @param Order_product_move $opm
     * @param $diff
     * @param bool $updateOpm
     * @return bool
     */
    public static function lowerQuantityOfProducts(Product $product, Order_product_move $opm, $diff, bool $updateOpm = true)
    {
        $bool1 = $bool2 = true;
        $ext_diff = $opm->quantity_ext - $diff;
        if($ext_diff >= 0)
        {
            $bool1 = $product->update([
                'quantity' => $product->quantity + $diff,
                'date_modified' => date("Y-m-d H:i:s")
            ]);
            if($updateOpm)
            {
                $bool2 = Order_product_move::where('order_product_move_id',$opm->order_product_move_id)
                    ->update([
                    'quantity_ext' => $opm->quantity_ext - $diff
                ]);
            }
        }
        if($ext_diff < 0)
        {
            $bool1 = $product->update([
                'quantity' => $product->quantity + $opm->quantity_ext,
                'internal_quantity' => $product->internal_quantity - $ext_diff,
                'date_modified' => date("Y-m-d H:i:s")
            ]);
            if($updateOpm)
            {
                $bool2 = Order_product_move::where('order_product_move_id',$opm->order_product_move_id)
                    ->update([
                    'quantity_ext' => 0,
                    'quantity_int' => $opm->quantity_int + $ext_diff
                ]);
            }
        }

        if($bool1 and $bool2) return true;
            else return false;
    }
}
