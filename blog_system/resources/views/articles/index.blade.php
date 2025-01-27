@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
    <h1>Artigos</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Criar Artigo</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
