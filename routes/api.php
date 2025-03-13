<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderDetailController;

 
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::get('/products',[ProductController::class, 'index']);
Route::get('/products/{id}',[ProductController::class, 'show']);
Route::post('/products',[ProductController::class, 'store']);


Route::get('/orders',[orderController::class, 'index']);
Route::get('/orders/{id}',[orderController::class, 'show']);
Route::post('/orders',[orderController::class, 'store']);


Route::get('/orderdetails',[OrderDetailController::class, 'index']);
Route::get('/orderdetails/{id}',[OrderDetailController::class, 'show']);
Route::post('/orderdetails',[OrderDetailController::class, 'store']);


