<?php

use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Transaction\ReceivingController;
use App\Http\Controllers\Transaction\ShippingController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\WarehouseController;
use App\Http\Controllers\Report\HistoryTransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'getIndex']);

Route::get('/supplier', [SupplierController::class, 'getIndex']);
Route::get('/customer', [CustomerController::class, 'getIndex']);
Route::get('/product', [ProductController::class, 'getIndex']);
Route::get('/warehouse', [WarehouseController::class, 'getIndex']);

Route::get('/receiving', [ReceivingController::class, 'getIndex']);
Route::get('/receiving/add', [ReceivingController::class, 'getAddForm']);
Route::post('/receiving/save', [ReceivingController::class, 'save']);
Route::get('/shipping', [ShippingController::class, 'getIndex']);
Route::get('/shipping/add', [ShippingController::class, 'getAddForm']);
Route::post('/shipping/save', [ShippingController::class, 'save']);

Route::get('/history-transaction', [HistoryTransactionController::class, 'getIndex']);
Route::get('/history-transaction/search', [HistoryTransactionController::class, 'search']);
