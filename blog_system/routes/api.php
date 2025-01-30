<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComentarioController;

Route::get('/artigos/{artigoId}/comentarios', [ComentarioController::class, 'index']);  // Para listar os comentários de um artigo
Route::post('/comentarios', [ComentarioController::class, 'store']);  // Para criar um novo comentário
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);  // Para excluir um comentário
