<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::orderBy('id', 'desc')->cursorPaginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
        ]);

        return Produto::create($request->all());
    }

    public function show(Produto $produto)
    {
        return $produto;
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto->update($request->all());

        return $produto;
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return response()->noContent();
    }

    public function relatorioInventario(Produto $produto, $tipo = null)
    {
        switch ($tipo) {
            case 'esgotados':
                $produtos = $produto::where('quantidade', 0)->get();
                break;
                
            case 'baixo-estoque':
                $produtos = $produto::where('quantidade', '<', 5)->get();
                break;
        }
        return response()->json($produtos);
    }
}
