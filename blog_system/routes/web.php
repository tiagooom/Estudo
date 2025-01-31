<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\CategoriaController;

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

//Route::get('/login', function () {
//    return view('login');
//});

Route::view('/', 'home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Exibe a view de login
Route::post('/login', [AuthController::class, 'login']); // Processa o login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Faz logout
Route::get('/register', [AuthController::class, 'showregisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('artigos', ArtigoController::class);
});


// routes/web.php
Route::middleware('api')->group(function () {
    require base_path('routes/api.php');
});
