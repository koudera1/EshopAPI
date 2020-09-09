<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_product;
use App\Order_product_move;
use App\Order_total;
use App\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class Order_totalController extends Controller
{
    /**
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function insertOrUpdate(Order $order, $update = 0)
    {
        $ops = Order_product::where('order_id', $order->order_id)->select('total','tax')->get();
        $tax = 0; $noTaxTotal = 0;
        foreach($ops as $op)
        {
            $noTaxTotal += $op->total;
            $taxCoeficient = '0.' . str_replace('.', '', $op->tax);
            $tax += $op->total * $taxCoeficient;
        }
        $bool0 = $order->update(['total' => $noTaxTotal + $tax]);

        $noTaxTotal = round($noTaxTotal * $order->value, 4);
        $tax = round($tax * $order->value, 4);
        $order->currency === 'CZK' ? $c = ' Kč' : $c = '€';

        $bool1 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem bez DPH',
                'sort_order' => 4
            ],
            [
                'text' => $noTaxTotal . $c,
                'value' => $noTaxTotal
            ]);

        $bool2 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'DPH ' . (int)Order_product::where('order_id', $order->order_id)->value('tax') . '%',
                'sort_order' => 5
            ],
            [
                'text' => $tax . $c,
                'value' => $tax
            ]);

        $bool3 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem s DPH',
                'sort_order' => 6
            ],
            [
                'text' => ($tax + $noTaxTotal) . $c,
                'value' => ($tax + $noTaxTotal)
            ]);

        if($bool0 and $bool1 and $bool2 and $bool3) return true;
        else return false;
    }
}
