<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Order_total;

class Order_totalService extends Controller
{
    public static function getOrder_totalValue($order_id, &$origNoTax, &$origTax)
    {
        $array = Order_total::where('order_id', $order_id)->get();
        if($array != [])
        {
            foreach($array as $struct) {
                if (4 == $struct->sort_order) {
                    $origNoTax = $struct->value;
                }
                if (5 == $struct->sort_order) {
                    $origTax = $struct->value;
                }
            }
        }
    }

    /**
     * @param Order $order
     * @param Order_product $op
     * @param $quantity
     * @param $action
     * @return bool
     */
    public static function updateOrInsert(Order $order, Order_product $op = null, $quantity, $action)
    {
        //$action == "add" ... add product
        //$action == "coupon" ... update price with new coupon
        //$action == "currency" ... update price with new currency

        $origNoTax = $origTax = 0;
        self::getOrder_totalValue($order->order_id, $origNoTax, $origTax);
        $tax = $noTax = 0;
        if($action === "add")
        {
            $coupon_discount = 1;
            if($order->coupon_id != 0) {
                $coupon = Coupon::find($order->coupon_id);
                if($coupon->shipping === 1 or ($coupon->shipping === 0 and $op->is_transfer != 1))
                {
                    $discountCoeficient = $coupon->discount / 100;
                    $coupon_discount = 1 - $discountCoeficient;
                }
            }

            $noTaxAddend = round($op->price * $quantity * $order->value * $coupon_discount, 4);
            $taxCoef = $op->tax / 100;
            $taxAddend = round($noTaxAddend * $taxCoef, 4);

            $tax = $origTax + $taxAddend;
            $noTax = $origNoTax + $noTaxAddend;

        } elseif ($action === "currency") {
            $tax = round($origTax * $order->value, 4);
            $noTax = round($origNoTax * $order->value, 4);
        } else {
            $coupon = Coupon::find($order->coupon_id);
            $discountCoeficient = $coupon->discount / 100;;
            $coupon_discount = 1 - $discountCoeficient;
            $tax = round($origTax * $coupon_discount, 4);
            $noTax = round($origNoTax * $coupon_discount, 4);
        }

        $total = $tax + $noTax;
        $bool1 = $order->update(['total' => $total]);
        $order->currency === 'CZK' ? $c = ' Kč' : $c = '€';

        $bool2 = Order_total::upsert([
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem bez DPH',
                'sort_order' => 4,
                'text' => $noTax . $c,
                'value' => $noTax
            ],
            [
                'order_id' => $order->order_id,
                'title' => 'DPH ' . round($tax / $noTax * 100, 0) . '%',
                'sort_order' => 5,
                'text' => $tax . $c,
                'value' => $tax
            ],
            [
                'order_id' => $order->order_id,
                'title' => 'Cena celkem s DPH',
                'sort_order' => 6,
                'text' => $total . $c,
                'value' => $total
            ],
        ], ['order_id', 'sort_order'], ['text', 'value']);


        if($bool1 and $bool2) return
            [
                'noTaxTotal' => $noTax,
                'tax' => $tax,
                'total' => $total
            ];
        else return false;
    }
}
