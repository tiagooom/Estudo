<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projetos = Projeto::latest()->orderby('id', 'desc')->cursorPaginate(5);

        return (view('projetos.index', ['projetos' => $projetos]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();

        return view('projetos.create', compact('usuarios'));
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
        ]);

        $projeto = Projeto::create([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
            'status' => request()->status
        ]);

        $projeto->usuarios()->attach(request()->usuario_id);
    
        return (redirect('projetos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Projeto $projeto)
    {
        $tarefas = Tarefa::where('projeto_id', $projeto->id)->get();

        return (view('projetos.show', ['projeto' => $projeto, 'tarefas' => $tarefas]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projeto = Projeto::findOrFail($id);

        $usuarios = User::all();

        return view('projetos.edit', compact('projeto', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projeto $projeto)
    {
        $request->validate([
            'titulo' => 'required', 
            'descricao' => 'required', 
            'data_inicio' => 'required', 
            'status' => 'required', 
        ]);
        
        $projeto->update([
            'titulo' => request()->titulo,
            'descricao' => request()->descricao,
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
            'status' => request()->status
        ]);

        if ($request->input('action') === 'add_user') {
            $projeto->usuarios()->attach(request()->add_user);
        }

        if ($request->input('action') === 'del_user') {
            $projeto->usuarios()->detach(request()->del_user);
        }

        return (redirect('projetos/'.$projeto->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();

        return (redirect('projetos')->with('delSuccess', 'Projeto removido com sucesso!'));
    }
}
