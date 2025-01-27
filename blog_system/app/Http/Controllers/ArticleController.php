<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all(); // Pega todos os artigos
        return view('articles.index', compact('articles')); // Retorna para a view com os artigos
    }

}
