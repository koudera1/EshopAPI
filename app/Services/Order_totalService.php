<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Order_total;
use App\Models\Product_special;

class Order_totalService extends Controller
{
    public static function addOrder_product(Order_product $op, $coupon_discount, &$noTaxTotal, &$tax, $cgid, $domain)
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
        $cgid = 0;
        if($order->customer_id != 0)
        {
            $customer = Customer::find($order->customer_id);
            if($customer->customer_group_id != 0)
            {
                $cgid = $customer->customer_group_id;
            }
        }

        if($coupon_discount === 1 or $shipping === 1)
        {
            foreach($ops as $op)
            {
                self::addOrder_product($op, $coupon_discount, $noTaxTotal, $tax, $cgid, $order->domain);
            }
        } else {
            foreach($ops as $op)
            {
                if($op->is_transfer)
                {
                    self::addOrder_product($op, 1, $noTaxTotal, $tax, $cgid, $order->domain);
                } else {
                    self::addOrder_product($op, $coupon_discount, $noTaxTotal, $tax, $cgid, $order->domain);
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

    /**
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public static function insertOrUpdate(Order $order, $update = 0)
    {
        $price = self::countPrice($order);
        if($price === 0) return true; /*customer deleted all his ordered products,
            database changes aren't necessary for now*/
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
                'title' => 'DPH ' . (int)($price['tax'] / $price['noTaxTotal'] * 100) . '%',
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
