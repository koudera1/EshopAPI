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
Route::get('/orders/{order}/price', 'API\OrderController@getPrice');
Route::get('/orders/{order}/shipping_methods', 'API\OrderController@getShipping_methods');
Route::get('/payment_methods', 'API\OrderController@getPayment_methods');
Route::get('/order_statuses', 'API\OrderController@getOrder_statuses');

Route::put('/orders/{order}/invoice', 'API\OrderController@putInvoice');

Route::apiResources([
    'orders' => 'API\OrderController',
    'orders.packages' => 'API\PackageController',
    'orders.history' => 'API\Order_historyController',
    'orders.products' => 'API\Order_productController',
    'products' => 'API\ProductController'
]);

