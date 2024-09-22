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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum', 'role:user');

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);


Route::post('/cart', [CartController::class, 'addToCart'])->middleware('auth:sanctum','role:user');
Route::delete('/cart/{cartId}/item/{productId}', [CartController::class, 'removeItem'])->middleware('auth:sanctum','role:user');
Route::post('/cart/{cartId}/item/{productId}/increase', [CartController::class, 'increment'])->middleware('auth:sanctum', 'role:user');
Route::post('/cart/{cartId}/item/{productId}/decrease', [CartController::class, 'decrement'])->middleware('auth:sanctum', 'role:user');
Route::post('/orders', [OrderController::class, 'create'])->middleware('auth:sanctum');