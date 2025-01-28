<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    public function index()
    {
        $artigos = Artigo::all(); // Pega todos os artigos
        return view('artigos.index', compact('artigos'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Pega todas as categorias
        return view('artigos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'corpo' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Artigo::create($validatedData);

        return redirect()->route('artigos.index')->with('success', 'Artigo criado com sucesso!');
    }

    public function edit($id)
    {
        $artigo = Artigo::findOrFail($id);
        $categorias = Categoria::all();
        return view('artigos.edit', compact('artigo', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'corpo' => 'required|string|min:100',
            'categoria_id' => 'required|exists:categorias,id',
            'publicado' => 'nullable|boolean',
        ]);

        $artigo = Artigo::findOrFail($id);
        $artigo->update($validatedData);

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $artigo = Artigo::findOrFail($id);
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo deletado com sucesso!');
    }
}
