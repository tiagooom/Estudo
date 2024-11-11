<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/produtos/relatorio/{tipo?}', [ProdutoController::class, 'relatorioInventario']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('produtos', ProdutoController::class);


Route::get('/produtos/relatorio/{tipo?}', [ProdutoController::class, 'relatorioInventario'])
    ->middleware(middleware: 'auth:sanctum');


