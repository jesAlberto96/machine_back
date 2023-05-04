<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/v1/coins', [App\Http\Controllers\Api\v1\CoinController::class, 'getAll']);
Route::get('/v1/products', [App\Http\Controllers\Api\v1\ProductController::class, 'getAll']);
Route::post('/v1/vending', [App\Http\Controllers\Api\v1\VendingController::class, 'store']);
