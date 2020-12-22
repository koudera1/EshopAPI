<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/orders/{order}/addresses', [OrderController::class, 'getAddresses']);
Route::get('/orders/{order}/price', [OrderController::class, 'getPrice']);
Route::get('/orders/{order}/shipping_methods', [OrderController::class, 'getShipping_methods']);
Route::get('/payment_methods', [OrderController::class, 'getPayment_methods']);
Route::get('/order_statuses', [OrderController::class, 'getOrder_statuses']);

Route::put('/orders/{order}/invoice', [OrderController::class, 'putInvoice']);
Route::get('/orders/{order}/invoice', function($order_id){
    $order = \App\Models\Order::find($order_id);
    $order_products = \App\Models\Order_product::where('order_id', $order->order_id)->get();
    $arr = explode("www.", $order->domain);
    $eshop = ucfirst($arr[1]);
    $date = date('d.m.Y');
    $date14 = date('d.m.Y', strtotime($date. ' + 14 days'));
    $same = false;
    if(
        $order->payment_company === $order->shipping_company and
        $order->payment_address_1 === $order->shipping_address_1 and
        $order->payment_city === $order->shipping_city and
        $order->payment_country === $order->shipping_country
    ) $same = true;

    return view('invoice', [
        'date' => $date,
        'date14' => $date14,
        'eshop' => $eshop,
        'order' => $order,
        'order_products' => $order_products,
        'same' => $same
    ],);
});

Route::apiResources([
    'orders' => API\OrderController::class,
    'orders.packages' => API\PackageController::class,
    'orders.history' => API\Order_historyController::class,
    'orders.products' => API\Order_productController::class,
    'customers' => API\CustomerController::class,
    'customer_groups' => API\Customer_groupController::class,
    'products' => API\ProductController::class,
    'products.gifts' => API\Product_giftController::class,
    'products.special' => API\Product_specialController::class,
    'coupons' => API\CouponController::class,
    'reviews' => API\ReviewController::class
]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
