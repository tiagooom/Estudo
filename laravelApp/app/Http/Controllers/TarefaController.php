<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefa::latest()->orderby('id', 'desc')->cursorPaginate(6);

        return (view('tarefas.index', ['tarefas' => $tarefas]));
    }
    public function create()
    {
        $usuarios = Usuario::all();

        return view('tarefas.create', compact('usuarios'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required', 
            'usuario_id' => 'required|exists:usuarios,id',       
        ]);

        Tarefa::create([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'usuario_id' => request()->usuario_id
        ]);
    
        return (redirect('tarefas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
