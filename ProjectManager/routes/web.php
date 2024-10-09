<?php

use App\Http\Controllers\RegistroController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::view('/', 'home');
Route::view('/login', 'auth.login');

Route::get('registro', [RegistroController::class, 'show']);
Route::post('registro', [RegistroController::class, 'create']);



