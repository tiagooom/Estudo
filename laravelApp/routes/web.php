<?php

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
//     return view('welcome');
// });

Route::view('/welcome', 'welcome');
Route::view('/', 'home');

Route::view('/usuarios/create', 'create');

Route::get('/usuarios', function() {
    $usuarios = App\Models\Usuario::latest()->orderby('id')->cursorPaginate(6);

    return (view('usuarios', ['usuarios' => $usuarios]));
});

Route::post('/usuarios', function() {
    App\Models\Usuario::create([
        'nome' => request()->nome,
        'email' => request()->email
    ]);

    $usuarios = App\Models\Usuario::latest()->orderby('id')->cursorPaginate(6);

    return (view('usuarios', ['usuarios' => $usuarios]));
});

Route::get('/usuarios/{id}', function($id) {
    $usuario = App\Models\Usuario::findOrFail($id);

    return (view('edit', ['usuario' => $usuario]));
});

Route::patch('/usuarios/{id}', function($id) {
    $usuario = App\Models\Usuario::findOrFail($id);

    $usuario->update([
        'nome' => request()->nome,
        'email' => request()->email
    ]);

    return (redirect('usuarios'));
});

Route::view('/tarefas', 'tarefas');

