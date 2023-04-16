<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testapi', function () {
    return 'testapi';
});

Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/product-creater', [ProductController::class, 'getProductByCreater']);

Route::middleware('auth:sanctum')->get('/carts', [CartController::class, 'index']);

Route::prefix('carts')->middleware('auth:sanctum')->name('carts.')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'addToCarts']);
});

// Route::prefix('orders')->middleware('auth:sanctum')->name('orders.')->group(function () {
//     Route::get('/', [OrderController::class, 'index']);
//     Route::post('/', [OrderController::class, 'addToOrders']);
// });

Route::resource('orders', OrderController::class);