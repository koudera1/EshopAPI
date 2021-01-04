<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order_product;
use App\Models\Order;
use App\Models\Order_product_move;
use App\Models\Product;

use App\Models\Product_special;
use App\Services\Order_totalService;
use App\services\Order_product_moveService;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @group Order_product
 */
class Order_productController extends Controller
{
    /**
     * Display a listing of all ordered products.
     * @urlParam order required order id Example: 35022
     * @response  {[
     * "order_product_id:112,
     * "order_id":50,
     * "product_id":183,
     * "name":"Náhradní hřebeny SP-HC5000",
     * "model":"4008496717552",
     * "price":207.5000,
     * "total":207.5000,
     * "tax":21.0000,
     * "quantity":1,
     * "sort_order":0,
     * "is_transfer":0,
     * "is_action":0,
     * "purchase_price":131.8200,
     * "warranty":24,
     * "gift":0
     * ]}
     *
     * @param Order $order
     * @return Collection
     * @throws AuthorizationException
     */
    public function index(Order $order)
    {
        $this->authorize('accessByAdminOrCustomer', $order);
        return $order->products()->get();
    }

    /**
     * Store a newly created ordered product in storage.
     * @urlParam order required order id Example: 35022
     * @bodyParam product_id integer required
     * @bodyParam quantity integer
     * @bodyParam sort_order integer
     * @bodyParam is_transfer integer
     * @bodyParam is_action integer
     * @response  {
     * "order_product_id":3332,
     * "noTaxTotal":100,
     * "tax":21,
     * "total":121
     * }
     *
     * @param Request $request
     * @param Order $order
     * @return array
     * @throws AuthorizationException
     */
    public function store(Request $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $product = Product::where('product_id', $request->input('product_id'))->firstOrFail();
        $price = $product->price;
        if($order->customer_id != 0)
        {
            $customer = Customer::find($order->customer_id);
            $cart = unserialize($customer->cart);
            $cart[$product->product_id] = $request->input('quantity');
            $customer->update([
                'cart' => serialize($cart)
            ]);

            if($customer->customer_group_id != 0)
            {
                $pid = $product->product_id;
                $cgid = $customer->customer_group_id;
                $domain = $order->domain;
                $price = Product_special
                    ::where('product_id', $pid)
                    ->where('customer_group_id', $cgid)
                    ->where('domain', $domain)
                    ->where('priority', function($query) use ($pid, $cgid, $domain)
                    {
                        $query->selectRaw('max(priority)')
                            ->where('product_id', $pid)
                            ->where('customer_group_id', $cgid)
                            ->where('domain', $domain);
                    })->value('price');
                if($price === null) $price = $product->price;
            }
        }

        $op = Order_product::create(
            [
                'order_id' => $order->order_id,
                'product_id' => $request->input('product_id'),
                'name' => DB::table('oc_product_description')
                    ->where('product_id', $request->input('product_id'))->value('name'),
                'tax' => preg_replace('/[^0-9]/', '', DB::table('oc_tax_class')
                    ->where('tax_class_id', $product->tax_class_id)->value('title')),
                'quantity' => $request->input('quantity',0),
                'sort_order' => $request->input('sort_order',0),
                'is_transfer' => $request->input('is_transfer',0),
                'is_action' => $request->input('is_action',0),
                'gift' => DB::table('oc_product_gift')
                    ->where('product_id', $product->product_id)
                    ->exists() ? 1 : 0,
                'model' => $product->model,
                'price' => $price,
                'purchase_price' => $product->purchase_price,
                'warranty' => $product->warranty,
                'total' => $price * $request->input('quantity',0)
            ]);

        Order_product_moveService::updateStock($order, $product, $request->input('quantity'));
        $order_total = Order_totalService::updateOrInsert($order, $op, $op->quantity, "add");

        return
            [
                'order_product_id' => $op->order_product_id,
                'noTaxTotal' => $order_total['noTaxTotal'],
                'tax' => $order_total['tax'],
                'total' => $order_total['total']
            ];
    }

    /**
     * Display the specified ordered product.
     * @urlParam order required order id Example: 35022
     * @urlParam order_product required order product id Example: 74850
     * @response  {
     * "order_product_id:112,
     * "order_id":50,
     * "product_id":183,
     * "name":"Náhradní hřebeny SP-HC5000",
     * "model":"4008496717552",
     * "price":207.5000,
     * "total":207.5000,
     * "tax":21.0000,
     * "quantity":1,
     * "sort_order":0,
     * "is_transfer":0,
     * "is_action":0,
     * "purchase_price":131.8200,
     * "warranty":24,
     * "gift":0
     * }
     *
     * @param Order $order
     * @param Product $product
     * @return Order_product
     * @throws AuthorizationException
     */
    public function show(Order $order, Product $product)
    {
        $this->authorize('accessByAdminOrCustomer', $order);
        return Order_product
            ::where('product_id', $product->product_id)
            ->where('order_id', $order->order_id)->first();
    }

    /**
     * Update the specified ordered product in storage.
     * @urlParam order required order id Example: 35022
     * @urlParam product required product id Example: 2400
     * @bodyParam quantity integer
     * @bodyParam sort_order integer
     * @bodyParam is_action integer
     * @response  {
     * "quantity":true,
     * "noTaxTotal":100,
     * "tax":21,
     * "total":121
     * }
     * @response  {
     * "quantity":false
     * }
     *
     * @param Request $request
     * @param Order $order
     * @param Product $product
     * @return array
     * @throws AuthorizationException
     */
    public function update(Request $request, Order $order, Product $product)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $order_product = Order_product::where('order_id', $order->order_id)
            ->where('product_id', $product->product_id)->firstOrFail();
        $bool1 = $bool2 = false;
        $ret_array = [];
        if ($request->has('quantity')) {
            $product = Product::where('product_id', $order_product->product_id)->firstOrFail();
            $opm = Order_product_move::where('product_id',$order_product->product_id)
                ->where('order_id',$order_product->order_id)->firstOrFail();
            $diff = $order_product->quantity - $request->input('quantity');
            if($diff > 0)//lowering quantity of products
            {
                $bool1 = $bool2 = Order_product_moveService::lowerQuantityOfProducts($product, $opm, $diff);
            }
            if($diff < 0)//adding more products
            {
                $diff = -$diff;//how many products to add
                $int_diff = $product->internal_quantity - $diff;
                if($int_diff >= 0)
                {
                    $bool1 = $product->update([
                        'internal_quantity' => $product->internal_quantity - $diff,
                        'date_modified' => date("Y-m-d H:i:s")
                    ]);
                    $bool2 = Order_product_move::where('order_product_move_id',$opm->order_product_move_id)
                        ->update([
                        'quantity_int' => $opm->quantity_int + $diff
                    ]);
                }
                if($int_diff < 0)
                {
                    $bool2 = Order_product_move::where('order_product_move_id',$opm->order_product_move_id)
                        ->update([
                        'order_product_move_id' => $opm->order_product_move_id,
                        'quantity_ext' => $opm->quantity_ext - $int_diff,
                        'quantity_int' => $opm->quantity_int + $product->internal_quantity
                    ]);
                    $bool1 = $product->update([
                        'quantity' => $product->quantity + $int_diff,
                        'internal_quantity' => 0,
                        'date_modified' => date("Y-m-d H:i:s")
                    ]);
                }
                $diff = -$diff;
            }

            $bool3 = $order_product->update([
                'quantity' => $request->input('quantity'),
                'total' => $product->price * $request->input('quantity'),
            ]);

            $order_total = Order_totalService::updateOrInsert($order, $order_product, -$diff, "add");

            if($order->customer_id != 0)
            {
                $customer = Customer::find($order->customer_id);
                $cart = unserialize($customer->cart);
                $cart[$product->product_id] = $request->input('quantity');
                $customer->update([
                    'cart' => serialize($cart)
                ]);
            }

            if($bool1 and $bool2 and $bool3)
                $ret_array +=
                    [
                        'quantity' => 'true',
                        'noTaxTotal' => $order_total['noTaxTotal'],
                        'tax' => $order_total['tax'],
                        'total' => $order_total['total']
                    ];
            else
                $ret_array += array('quantity' => false);
        }
        if ($request->has('sort_order')) {
            $ret_array += array('sort_order' => $product->update([
                'sort_order' => $request->input('sort_order')
            ]));
        }
        if ($request->has('is_action')) {
            $ret_array += array('is_action' => $product->update([
                'is_action' => $request->input('is_action')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified ordered product from storage.
     * @urlParam order required order id Example: 35022
     * @urlParam product required product id Example: 2400
     * @response true
     * @response  {
     * "noTaxTotal":100,
     * "tax":21,
     * "total":121
     * }
     *
     * @param Order $order
     * @param $product_id
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Order $order, $product_id)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $order_product = Order_product::where('order_id', $order->order_id)
            ->where('product_id', $product_id)->firstOrFail();

        if($product_id == 0)
        {
            $order_total = Order_totalService::updateOrInsert($order, $order_product, -$order_product->quantity, "add");
            if($order_product->delete()) {
                return response()->json([
                    'noTaxTotal' => $order_total['noTaxTotal'],
                    'tax' => $order_total['tax'],
                    'total' => $order_total['total']
                ]);
            }
        }

        $product = Product::find($product_id);
        if(Order_product_moveService::updateProductsWhenDeleting($order_product, $product))
        {
            $order_total = Order_totalService::updateOrInsert($order, $order_product, -$order_product->quantity, "add");
            if($order_product->delete()) {
                return response()->json([
                    'noTaxTotal' => $order_total['noTaxTotal'],
                    'tax' => $order_total['tax'],
                    'total' => $order_total['total']
                ]);
            }
        }
        return response()->json(false);
    }

}
