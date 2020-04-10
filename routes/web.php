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

Route::get('/orders/{order}/addresses', 'API\OrderController@addresses');
Route::get('/orders/{order}/history', 'API\OrderController@history');
Route::get('/orders/{order}/products', 'API\Order_productController@index');

Route::put('/orders/{order}/domain', 'API\OrderController@domain');
Route::put('/orders/{order}/firstname', 'API\OrderController@firstname');
Route::put('/orders/{order}/lastname', 'API\OrderController@lastname');
Route::put('/orders/{order}/comment', 'API\OrderController@comment');
Route::put('/orders/{order}/order_status', 'API\OrderController@order_status');
Route::put('/orders/{order}/shipping_method', 'API\OrderController@dshipping_method');
Route::put('/orders/{order}/label', 'API\OrderController@label');
Route::put('/orders/{order}/total', 'API\OrderController@total');
Route::put('/orders/{order}/payment_status', 'API\OrderController@payment_status');
Route::put('/orders/{order}/profit', 'API\OrderController@profit');
Route::put('/orders/{order}/slovakia', 'API\OrderController@slovakia');
Route::put('/orders/{order}/instock', 'API\OrderController@instock');
Route::put('/orders/{order}/referrer', 'API\OrderController@referrer');
Route::put('/orders/{order}/agree_gdpr', 'API\OrderController@agree_gdpr');
Route::put('/orders/{order}/payment_method', 'API\OrderController@payment_method');
Route::put('/orders/{order}/email', 'API\OrderController@email');
Route::put('/orders/{order}/telephone', 'API\OrderController@telephone');

Route::apiResources([
    'orders' => 'API\OrderController',
    'orders.packages' => 'API\PackageController',
    'order_products' => 'API\Order_productController',
    'products' => 'API\ProductController'
]);
