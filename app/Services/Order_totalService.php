<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Order_total;

class Order_totalService extends Controller
{
    public static function addOrder_product(Order_product $op, $coupon_discount, &$noTaxTotal, &$tax)
    {
        $noTaxTotal += $op->total * $coupon_discount;
        $taxCoeficient = '0.' . str_replace('.', '', $op->tax);
        $tax += $op->total * $taxCoeficient * $coupon_discount;
    }

    public static function countPrice(Order $order)
    {
        $ops = Order_product::where('order_id', $order->order_id)->select('total','tax', 'is_transfer')->get();
        $tax = 0; $noTaxTotal = 0;
        $coupon_discount = 1; $shipping = 1;
        if($order->coupon_id != 0)
        {
            $coupon = Coupon::find($order->coupon_id);
            $discountCoeficient = '0.' . str_replace('.', '', $coupon->discount);
            $coupon_discount = 1 - $discountCoeficient;
            if($coupon->shipping != 1) $shipping = 0;
        }

        if($coupon_discount === 1 or $shipping === 1)
        {
            foreach($ops as $op)
            {
                self::addOrder_product($op, $coupon_discount, $noTaxTotal, $tax);
            }
        } else {
            foreach($ops as $op)
            {
                if($op->is_transfer)
                {
                    self::addOrder_product($op, 1, $noTaxTotal, $tax);
                } else {
                    self::addOrder_product($op, $coupon_discount, $noTaxTotal, $tax);
                }
            }
        }

        $noTaxTotal = round($noTaxTotal * $order->value, 4);
        $tax = round($tax * $order->value, 4);

        return [
            'noTaxTotal' => $noTaxTotal,
            'tax' => $tax
        ];
    }

    public static function useCoupon(Order $order)
    {

    }

    /**
     * @param Order $order
     * @param Order_product $op
     * @param $quantity
     * @param $plus
     * @return bool
     */
    public static function updateOrCreateTotalPrice(Order $order, Order_product $op, $quantity, $action)
    {
        //$action == 1 ... add product
        //$action == -1 ... subtract product
        //$action == "coupon" ... update price with new coupon
        //$action == "currency" ... update price with new currency

        $array = Order_total::where('order_id', $order->order_id)->get();
        $origNoTax = $origTax = 0;
        if($array != [])
        {
            $noTax = null; $tax = null;
            foreach($array as $struct) {
                if (4 == $struct->sort_order) {
                    $origNoTax = $struct->value;
                    break;
                }
                if (5 == $struct->sort_order) {
                    $origTax = $struct->value;
                    break;
                }
            }
        }

        $tax = $noTax = 0;
        if($action === 1 or $action === -1)
        {
            $coupon_discount = 1;
            if($order->coupon_id != 0) {

                $coupon = Coupon::find($order->coupon_id);
                if($coupon->shipping === 1 or ($coupon->shipping === 0 and $op->is_transfer != 1))
                {
                    $discountCoeficient = '0.' . str_replace('.', '', $coupon->discount);
                    $coupon_discount = 1 - $discountCoeficient;
                }
            }

            $noTaxAddend = round($op->price * $quantity * $action * $order->value * $coupon_discount, 4);
            $taxCoef = '0.' . str_replace('.', '', $op->tax);
            $taxAddend = round($noTaxAddend * $taxCoef, 4);

            $tax = $origTax + $taxAddend;
            $noTax = $origNoTax + $noTaxAddend;

        } elseif ($action === "currency") {
            $tax = round($origTax * $order->value, 4);
            $noTax = round($origNoTax * $order->value, 4);
        } else {
            $coupon = Coupon::find($order->coupon_id);
            $discountCoeficient = '0.' . str_replace('.', '', $coupon->discount);
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
                'title' => 'DPH ' . (int)($tax / $noTax * 100) . '%',
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
        ], ['order_id', 'title', 'sort_order'], ['text', 'value']);


        if($bool1 and $bool2) return true;
        else return false;
    }
}
