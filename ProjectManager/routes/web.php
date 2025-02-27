<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TarefaController;
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

Route::view('/', 'home')->name('home');

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

Route::get('registro', [RegistroController::class, 'show']);
Route::post('registro', [RegistroController::class, 'create']);

Route::resource('projetos', ProjetoController::class)->middleware('auth');
Route::resource('tarefas', TarefaController::class)->middleware('auth');



