<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Produto::all();
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
}
