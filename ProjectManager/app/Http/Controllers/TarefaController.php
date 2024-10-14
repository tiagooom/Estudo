<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usuarios = User::all();
        
        $tarefas = QueryBuilder::for(Tarefa::class)
            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::exact('data_inicio'),
                AllowedFilter::exact('usuario_id'),
            ])
            ->cursorPaginate(5);

        return (view('tarefas.index', ['tarefas' => $tarefas, 'usuarios' => $usuarios]));
    }

    public function create()
    {
        $usuarios = User::all();

        $projeto = Projeto::findOrFail(request()->projeto);

        return view('tarefas.create', compact('usuarios', 'projeto'));
    }

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

    public function show(Tarefa $tarefa)
    {
        return (view('tarefas.show', ['tarefa' => $tarefa]));
    }

    public function edit(Tarefa $tarefa)
    {
        $usuarios = User::all();

        return view('tarefas.edit', compact('tarefa', 'usuarios'));
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required', 
            'descricao' => 'required', 
            'data_inicio' => 'required', 
            'status' => 'required', 
            'usuario_id' => 'required',
        ]);

        $qtdTarefas = Tarefa::where('usuario_id', '=', $request->usuario_id)->count();

        if (($qtdTarefas >= 5) && ($request->usuario_id != $tarefa->usuario_id)) {
            return redirect()->back()->withErrors(['usuario_id' => 'O usuário já tem o limite de 5 tarefas.'])->withInput();
        }
        
        $tarefa->update([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
            'status' => request()->status, 
            'usuario_id' => request()->usuario_id, 
            'projeto_id' => request()->projeto_id,
        ]);

        return (redirect('tarefas/'.$tarefa->id));
    }

    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return (redirect('tarefas')->with('delSuccess', 'Tarefa removida com sucesso!'));
    }
}
