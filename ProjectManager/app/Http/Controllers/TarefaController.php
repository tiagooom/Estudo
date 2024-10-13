<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefa::latest()->orderby('id', 'desc')->cursorPaginate(5);

        return (view('tarefas.index', ['tarefas' => $tarefas]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();

        $projeto = Projeto::findOrFail(request()->projeto);

        return view('tarefas.create', compact('usuarios', 'projeto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required', 
            'descricao' => 'required', 
            'data_inicio' => 'required', 
            'status' => 'required', 
            'usuario_id' => 'required',
        ]);

        $qtdTarefas = Tarefa::where('usuario_id', '=', $request->usuario_id)->count();

        if (($qtdTarefas >= 5)) {
            return redirect()->back()->withErrors(['usuario_id' => 'O usuário já tem o limite de 5 tarefas.'])->withInput();
        }

        $tarefa = Tarefa::create([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
            'status' => request()->status, 
            'usuario_id' => request()->usuario_id, 
            'projeto_id' => request()->projeto_id,
        ]);
    
        return (redirect('projetos/'.$tarefa->projeto_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}