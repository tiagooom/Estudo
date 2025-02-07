<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|url',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product);
        }

        return response()->json(['message' => 'Produto não encontrado'], 404);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'image' => 'nullable|url',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produto excluído com sucesso']);
    }
}