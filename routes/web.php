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

Route::apiResources([
    'orders' => 'API\OrderController',
    'orders.products' => 'API\OrderedProductController',
    'ordered_products' => 'API\OrderedProductController',
    'products' => 'API\ProductController'
]);
