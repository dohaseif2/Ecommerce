<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/login',[AuthController::class,'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
