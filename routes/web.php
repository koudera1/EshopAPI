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
Route::post('/log_in', [LoginController::class, 'authenticate'])->name('log_in');

Route::get('/orders/{order}/addresses', [OrderController::class, 'getAddresses']);
Route::get('/orders/{order}/price', [OrderController::class, 'getPrice']);
Route::get('/orders/{order}/shipping_methods', [OrderController::class, 'getShipping_methods']);
Route::get('/payment_methods', [OrderController::class, 'getPayment_methods']);
Route::get('/order_statuses', [OrderController::class, 'getOrder_statuses']);

Route::put('/orders/{order}/invoice', [OrderController::class, 'putInvoice']);

Route::apiResources([
    'orders' => API\OrderController::class,
    'orders.packages' => API\PackageController::class,
    'orders.history' => API\Order_historyController::class,
    'orders.products' => API\Order_productController::class,
    'products' => API\ProductController::class
]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
