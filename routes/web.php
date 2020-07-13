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
use App\Http\Controllers\API;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/orders/{order}/addresses', 'API\OrderController@getAddresses');
Route::get('/orders/{order}/price', 'API\OrderController@price');

Route::put('/orders/{order}/addresses', 'API\OrderController@putAddresses');
Route::put('/orders/{order}/invoice', 'API\OrderController@invoice');
Route::put('/orders/{order}/domain', 'API\OrderController@domain');
Route::put('/orders/{order}/currency', 'API\OrderController@currency');
Route::put('/orders/{order}/language', 'API\OrderController@language');
Route::put('/orders/{order}/firstname', 'API\OrderController@firstname');
Route::put('/orders/{order}/lastname', 'API\OrderController@lastname');
Route::put('/orders/{order}/company', 'API\OrderController@company');
Route::put('/orders/{order}/comment', 'API\OrderController@comment');
Route::put('/orders/{order}/order_status', 'API\OrderController@order_status');
Route::put('/orders/{order}/shipping_method', 'API\OrderController@shipping_method');
Route::put('/orders/{order}/total', 'API\OrderController@total');
Route::put('/orders/{order}/payment_status', 'API\OrderController@payment_status');
Route::put('/orders/{order}/slovakia', 'API\OrderController@slovakia');
Route::put('/orders/{order}/referrer', 'API\OrderController@referrer');
Route::put('/orders/{order}/agree_gdpr', 'API\OrderController@agree_gdpr');
Route::put('/orders/{order}/payment_method', 'API\OrderController@payment_method');
Route::put('/orders/{order}/email', 'API\OrderController@email');
Route::put('/orders/{order}/telephone', 'API\OrderController@telephone');
Route::put('/orders/{order}/fax', 'API\OrderController@fax');
Route::put('/orders/{order}/regNum', 'API\OrderController@regNum');
Route::put('/orders/{order}/taxRegNum', 'API\OrderController@taxRegNum');
Route::put('/orders/{order}/coupon_id', 'API\OrderController@coupon_id');
Route::put('/orders/{order}/shipping_gp', 'API\OrderController@shipping_gp');
Route::put('/orders/{order}/ip', 'API\OrderController@ip');
Route::put('/orders/{order}/reason', 'API\OrderController@reason');
Route::put('/orders/{order}/wrong_order_id', 'API\OrderController@wrong_order_id');
Route::put('/orders/{order}/competition', 'API\OrderController@competition');
Route::put('/orders/{order}/euVAT', 'API\OrderController@euVAT');
Route::put('/orders/{order}/viewed', 'API\OrderController@viewed');


Route::get('/shipping_methods_cz', 'API\OrderController@shipping_methods_cz');
Route::get('/shipping_methods_sk', 'API\OrderController@shipping_methods_sk');
Route::get('/payment_methods', 'API\OrderController@payment_methods');
Route::get('/order_statuses', 'API\OrderController@order_statuses');

Route::apiResources([
    'orders' => 'API\OrderController',
    'orders.packages' => 'API\PackageController',
    'orders.history' => 'API\Order_historyController',
    'orders.products' => 'API\Order_productController',
    'orders.products.moves' => 'API\Order_product_moveController',
    'products' => 'API\ProductController'
]);
