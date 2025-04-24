<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::POST('/login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('products',ProductController::class);
    Route::apiResource('cart',CartItemController::class);
});
