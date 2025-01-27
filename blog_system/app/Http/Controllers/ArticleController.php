<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all(); // Pega todos os artigos
        return view('articles.index', compact('articles')); // Retorna para a view com os artigos
    }

    public function create()
    {
        $categories = Category::all(); // Pega todas as categorias para exibir no select
        return view('articles.create', compact('categories')); // Retorna para o formulário de criação
    }


}
