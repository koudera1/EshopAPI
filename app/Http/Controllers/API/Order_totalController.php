<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Order_product_move;
use App\Models\Order_total;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class Order_totalController extends Controller
{
    public static function countPrice(Order $order)
    {
        $ops = Order_product::where('order_id', $order->order_id)->select('total','tax')->get();
        $tax = 0; $noTaxTotal = 0;
        foreach($ops as $op)
        {
            $noTaxTotal += $op->total;
            $taxCoeficient = '0.' . str_replace('.', '', $op->tax);
            $tax += $op->total * $taxCoeficient;
        }

        $noTaxTotal = round($noTaxTotal * $order->value, 4);
        $tax = round($tax * $order->value, 4);

        return [
            'noTaxTotal' => $noTaxTotal,
            'tax' => $tax
        ];
    }

    /**
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public static function insertOrUpdate(Order $order, $update = 0)
    {
        $price = self::countPrice($order);
        $bool0 = $order->update(['total' => $price['noTaxTotal'] + $price['tax']]);
        $order->currency === 'CZK' ? $c = ' Kč' : $c = '€';

        $bool1 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem bez DPH',
                'sort_order' => 4
            ],
            [
                'text' => $price['noTaxTotal'] . $c,
                'value' => $price['noTaxTotal']
            ]);

        $bool2 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'DPH ' . (int)Order_product::where('order_id', $order->order_id)->value('tax') . '%',
                'sort_order' => 5
            ],
            [
                'text' => $price['tax'] . $c,
                'value' => $price['tax']
            ]);

        $bool3 = Order_total::updateOrInsert(
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem s DPH',
                'sort_order' => 6
            ],
            [
                'text' => ($price['tax'] + $price['noTaxTotal']) . $c,
                'value' => ($price['tax'] + $price['noTaxTotal'])
            ]);

        if($bool0 and $bool1 and $bool2 and $bool3) return true;
        else return false;
    }
}
