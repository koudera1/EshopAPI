<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order_product;
use App\Models\Order;
use App\Models\Order_product_move;
use App\Models\Product;

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
     * Display a listing of ordered products.
     * @urlParam order required order id Example: 35022
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
     * @bodyParam name string required
     * @bodyParam tax integer
     * @bodyParam quantity integer
     * @bodyParam sort_order integer
     * @bodyParam is_transfer integer
     * @bodyParam is_action integer
     * @response  {
     * "order_product_id":3332
     * }
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $product = Product::where('product_id', $request->input('product_id'))->firstOrFail();
        $opid = Order_product::insertGetId(
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
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'warranty' => $product->warranty,
                'total' => $product->price * $request->input('quantity',0)
            ]);

        if($order->customer_id != 0)
        {
            $customer = Customer::find($order->customer_id);
            $cart = unserialize($customer->cart);
            $cart[$product->product_id] = $request->input('quantity');
            $customer->update([
                'cart' => serialize($cart)
            ]);
        }

        Order_product_moveController::updateStock($order, $product, $request->input('quantity'));
        Order_totalController::insertOrUpdate($order, 1);

        return response()->json(
            [
                'order_product_id' => $opid
            ]
        );
    }

    /**
     * Display the specified ordered product.
     * @urlParam order required order id Example: 35022
     * @urlParam order_product required order product id Example: 74850
     *
     * @param Order_product $order_product
     * @return Order_product
     */
    public function show(Order_product $order_product)
    {
        return $order_product;
    }

    /**
     * Update the specified ordered product in storage.
     * @urlParam order required order id Example: 35022
     * @urlParam product required product id Example: 2400
     * @bodyParam quantity integer
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
                $bool1 = $bool2 = Order_product_moveController::lowerQuantityOfProducts($product,$opm,$diff);
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
            }

            $bool3 = $order_product->update([
                'quantity' => $request->input('quantity'),
                'total' => $product->price * $request->input('quantity'),
            ]);

            $bool4 = Order_totalController::insertOrUpdate($order, 1);

            if($order->customer_id != 0)
            {
                $customer = Customer::find($order->customer_id);
                $cart = unserialize($customer->cart);
                $cart[$product->product_id] = $request->input('quantity');
                $customer->update([
                    'cart' => serialize($cart)
                ]);
            }

            if($bool1 and $bool2 and $bool3 and $bool4)
                $ret_array += array('quantity' => true);
            else
                $ret_array += array('quantity' => false);
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified ordered product from storage.
     * @urlParam order required order id Example: 35022
     * @urlParam product required product id Example: 2400
     * @response true
     *
     * @param Order $order
     * @param Product $product
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Order $order, Product $product)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $order_product = Order_product::where('order_id', $order->order_id)
            ->where('product_id', $product->product_id)->firstOrFail();

        if(self::updateProductsWhenDeleting($order_product, $product))
        {
            if($order_product->delete()) {
                if(Order_totalController::insertOrUpdate($order))
                    return response()->json(true);
                else return response()->json(false);
            }
        }
        return response()->json(false);
    }

    /**
     * Lower quantity of products counted in order and delete order_product_move.
     *
     * @param Order_product $order_product
     * @param Product $product
     * @return bool
     */
    public static function updateProductsWhenDeleting(Order_product $order_product, Product $product)
    {
        $opm = Order_product_move::where('product_id',$order_product->product_id)
            ->where('order_id',$order_product->order_id)->first();
        $diff = $order_product->quantity;
        $bool1 = Order_product_moveController
            ::lowerQuantityOfProducts($product, $opm, $diff, false);
        $bool2 = $opm->delete();
        if($bool1 and $bool2) return true;
        else return false;
    }
}
