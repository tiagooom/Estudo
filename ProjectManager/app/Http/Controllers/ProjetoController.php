<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
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
        $usuarios = User::all();

        return (view('projetos.show', ['projeto' => $projeto, 'usuarios' => $usuarios]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
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
