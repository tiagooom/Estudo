@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
    <h1>Artigos</h1>

    <a href="{{ route('artigos.create') }}" class="btn btn-primary rounded-pill px-3 my-3">Criar Artigo</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artigos as $artigo)
                <tr>
                    <td>{{ $artigo->titulo }}</td>
                    <td>{{ $artigo->categoria->nome }}</td>
                    <td>
                        <a href="{{ route('artigos.edit', $artigo->id) }}" class="btn btn-secondary rounded-pill px-3">Editar</a>
                        <form action="{{ route('artigos.destroy', $artigo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-3">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
