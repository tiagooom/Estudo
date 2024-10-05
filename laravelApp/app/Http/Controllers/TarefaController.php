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

        if (request()->wantsJson() || request()->has('json')) {
            return response()->json($tarefas); 
        }

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

        $qtdTarefas = Tarefa::where('usuario_id', '=', $request->usuario_id)->count();

        if ($qtdTarefas >= 5) {
            return redirect()->back()->withErrors(['usuario_id' => 'O usuário já tem o limite de 5 tarefas.'])->withInput();
        }

        Tarefa::create([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'usuario_id' => request()->usuario_id
        ]);
    
        return (redirect('tarefas'));
    }
    public function show(Tarefa $tarefa)
    {
        $usuarios = Usuario::all();

        return (view('tarefas.show', ['tarefa' => $tarefa, 'usuarios' => $usuarios]));
    }

    public function edit(Tarefa $tarefa)
    {
        $usuarios = Usuario::all();

        return (view('tarefas.edit', ['tarefa' => $tarefa, 'usuarios' => $usuarios]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required', 
            'usuario_id' => 'required|exists:usuarios,id',       
        ]);

        $qtdTarefas = Tarefa::where('usuario_id', '=', $request->usuario_id)->count();

        if (($qtdTarefas >= 5) && ($request->usuario_id != $tarefa->usuario_id)) {
            return redirect()->back()->withErrors(['usuario_id' => 'O usuário já tem o limite de 5 tarefas.'])->withInput();
        }
        
        $tarefa->update([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'usuario_id' => request()->usuario_id
        ]);

        return (redirect('tarefas'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect('tarefas')->with('success', 'Tarefa deletada com sucesso!');
    }
}
