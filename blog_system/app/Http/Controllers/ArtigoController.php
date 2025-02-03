<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

class ArtigoController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
    
        if ($page == 1) {
            // Apenas a página 1 será armazenada no cache
            $artigos = Cache::remember("artigos_lista_page_1", 60, function () {
                return Artigo::orderBy('created_at', 'desc')->paginate(6);
            });
        } else {
            // Outras páginas sempre serão buscadas diretamente do banco
            $artigos = Artigo::orderBy('created_at', 'desc')->paginate(6);
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
        $categorias = Categoria::all(); 
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
    Cache::forget("artigos_lista_page_1");

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
        Cache::forget("artigos_lista_page_1");

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $artigo = Artigo::findOrFail($id);
        $this->authorize('delete', $artigo);
        $artigo->delete();
        Cache::forget("artigos_lista_page_1");

        return redirect()->route('artigos.index')->with('success', 'Artigo deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $titulo = $request->input('titulo');
        $categoria_id = $request->input('categoria');

        $artigos = Artigo::query()
        ->when($titulo, function ($query, $titulo) {
            return $query->where('titulo', 'like', '%' . $titulo . '%')
                        ->orWhere('corpo', 'like', '%' . $titulo . '%');
        })
        ->when($categoria_id, function ($query, $categoria_id) {
            return $query->where('categoria_id', $categoria_id);
        })
        ->paginate(6);


        $categorias = Categoria::all();

        return view('artigos.index', compact('artigos', 'categorias'));
    }


}
