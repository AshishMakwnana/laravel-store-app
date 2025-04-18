<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::POST('/login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('products',ProductController::class);
});
