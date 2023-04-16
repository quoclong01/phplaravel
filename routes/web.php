<?php

use App\Http\Controllers\CheckAgeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/user', [UserController::class, 'index']);
Route::prefix('product')->middleware('auth')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
});
Route::get('/checkAge/{age}', [CheckAgeController::class, 'index'])->middleware('checkAge');
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');