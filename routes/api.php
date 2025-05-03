<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::POST('/login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    // admin product url
    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::apiResource('adminProducts',AdminProductController::class);
        Route::get('/orders/all',[OrderController::class,'allOrders']);
    });
    Route::apiResource('products',ProductController::class);
    Route::apiResource('cart',CartItemController::class);
    Route::apiResource('order',OrderController::class);
});
