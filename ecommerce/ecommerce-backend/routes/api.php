<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Rotas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);;

// Grupo de rotas que exigem autenticação via Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });

    Route::middleware('admin')->group(function () {
        Route::apiResource('products', ProductController::class)->except(['index', 'show']);;
        Route::apiResource('categories', CategoryController::class);
    });

    //Rotas para carrinho
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/cart/sync', [CartController::class, 'sync']);
    Route::put('/cart/decrease', [CartController::class, 'decreaseQuantity']);
    Route::delete('/cart/clear', [CartController::class, 'clear']);
    Route::delete('/cart/{product_id}', [CartController::class, 'destroy']);
});
