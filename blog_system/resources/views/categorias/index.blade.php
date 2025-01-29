@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Categorias</h1>

        <!-- Botão para criar nova categoria -->
        <a href="{{ route('categorias.create') }}" class="btn btn-primary rounded-pill px-3 my-3">Criar Categoria</a>

        <!-- Tabela de categorias -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nome }}</td>
                        <td>
                            <!-- Botões de Ação: Editar e Deletar -->
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-secondary rounded-pill px-3">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-3">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
