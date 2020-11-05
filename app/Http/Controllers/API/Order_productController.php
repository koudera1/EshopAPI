<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order_history;
use App\Models\Order_product;
use App\Models\Order;
use App\Models\Order_product_move;
use App\Models\Order_total;
use App\Models\Product;

use Exception as ExceptionAlias;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @bodyParam gift integer
     * @response  {
     * "order_product_id":3332
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $product = Product::where('product_id', $request->input('product_id'))->first();
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
                'gift' => $request->input('gift',0),
                'model' => $product->model,
                'price' => $product->price,
                'purchase_price' => $product->purchase_price,
                'warranty' => $product->warranty,
                'total' => $product->price * $request->input('quantity',0)
            ]);

        $opmc = new Order_product_moveController();
        $opmc->updateStock($order, $product, $request->input('quantity'));

        $order_product = Order_product::find($opid);
        $otc = new Order_totalController();
        $bool4 = $otc->insertOrUpdate($order, 1);

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
     * @param  \App\Order_product  $order_product
     * @return \Illuminate\Http\Response
     */
    public function show(Order_product $order_product)
    {
        return $order_product;
    }

    /**
     * Update the specified ordered product in storage.
     * @urlParam order required order id Example: 35022
     * @urlParam order_product required order product id Example: 74850
     * @bodyParam quantity integer
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @param \App\Order_product $order_product
     * @return void
     */
    public function update(Request $request, Order $order, $opid)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $order_product = Order_product::find($opid);
        $bool1 = $bool2 = false;
        $ret_array = [];
        if ($request->has('quantity')) {
            $product = Product::where('product_id', $order_product->product_id)->first();
            $opm = Order_product_move::where('product_id',$order_product->product_id)
                ->where('order_id',$order_product->order_id)->first();
            $diff = $order_product->quantity - $request->input('quantity');
            if($diff > 0)//lowering quantity of products
            {
                $opmc = new Order_product_moveController();
                $bool1 = $bool2 = $opmc->lowerQuantityOfProducts($product,$opm,$diff);
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

            $total = $order_product->total;
            $quantity = $order_product->quantity;
            $bool3 = $order_product->update([
                'quantity' => $request->input('quantity'),
                'total' => $product->price * $request->input('quantity'),
            ]);

            $otc = new Order_totalController();
            $bool4 = $otc->insertOrUpdate($order, 1);

            if($bool1 and $bool2 and $bool3 and $bool4)
                $ret_array += array('quantity' => true);
            else
                $ret_array += array('quantity' => false);
        }

        return $ret_array;
    }

    /**
     * Remove the specified ordered product from storage.
     * @urlParam order required order id Example: 35022
     * @urlParam order_product required order product id Example: 74850
     * @response true
     *
     * @param \App\Order_product $order_product
     * @return \Illuminate\Http\Response
     * @throws ExceptionAlias
     */
    public function destroy(Order $order, $opid)
    {
        $this->authorize('updateByAdminOrCustomer', $order);
        $order_product = Order_product::find($opid);

        $product = Product::where('product_id', $order_product->product_id)->first();
        $opm = Order_product_move::where('product_id',$order_product->product_id)
            ->where('order_id',$order_product->order_id)->first();
        $diff = $order_product->quantity;
        $opmc = new Order_product_moveController();
        $bool2 = $opmc->lowerQuantityOfProducts($product, $opm, $diff, false);

        if(Order_product_move::where('order_id', $order->order_id)
            ->where('product_id', $order_product->product_id)->delete())
        {
            if($order_product->delete()) {
                $otc = new Order_totalController();
                $bool1 = $otc->insertOrUpdate($order, 1);

                if($bool1 and $bool2) return response()->json(true);
                else return response()->json(false);
            }
        }
        return response()->json(false);

    }
}
