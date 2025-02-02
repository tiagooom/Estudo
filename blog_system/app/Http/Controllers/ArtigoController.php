<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArtigoController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $categoria_id = $request->input('categoria');

        if ($categoria_id) {
            $artigos = Artigo::where('categoria_id', $categoria_id)->get();
        } else {
            $artigos = Artigo::all();
        }

        $categorias = Categoria::all();

        return view('artigos.index', compact('artigos', 'categorias'));
    }

    public function show($id)
{
    $artigo = Artigo::findOrFail($id); 
    $comentarios = $artigo->comentarios; 

    return view('artigos.show', compact('artigo', 'comentarios'));
}


    public function create()
    {
        $categorias = Categoria::all(); // Pega todas as categorias
        return view('artigos.create', compact('categorias'));
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Usuário não autenticado'], 401);
    }

    $user = Auth::user();

    $validatedData = $request->validate([
        'titulo' => 'required|string|max:255',
        'corpo' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $validatedData['user_id'] = $user->id;

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
        if (!Auth::check()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
        
        $user = Auth::user();

        $artigo = Artigo::findOrFail($id);
        $this->authorize('update', $artigo);

        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'corpo' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $validatedData['user_id'] = $user->id;

        $artigo->update($validatedData);

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $artigo = Artigo::findOrFail($id);
        $this->authorize('delete', $artigo);
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categoria_id = $request->input('categoria');

        $artigos = Artigo::when($search, function ($query, $search) {
                $query->where('titulo', 'like', "%{$search}%")
                    ->orWhere('corpo', 'like', "%{$search}%");
            })
            ->when($categoria_id, function ($query, $categoria_id) {
                $query->where('categoria_id', $categoria_id);
            })
            ->get();

        $categorias = Categoria::all();

        return view('artigos.index', compact('artigos', 'categorias'));
    }


}
