<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class,'login']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);


Route::post('/cart', [CartController::class, 'addToCart']);
Route::delete('/cart/{cartId}/item/{productId}', [CartController::class, 'removeItem']);
Route::post('/cart/{cartId}/item/{productId}/increase', [CartController::class, 'increment']);
Route::post('/cart/{cartId}/item/{productId}/decrease', [CartController::class, 'decrement']);
Route::post('/orders', [OrderController::class, 'create']);
