@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
    <h1>Artigos</h1>

    <!-- Formulário de Filtro de Categoria -->
    <form action="{{ route('artigos.index') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="categoria" class="form-label">Filtrar por Categoria</label>
                <select class="form-select" id="categoria" name="categoria">
                    <option value="">Todas as Categorias</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

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
                    <td><a href="{{ route('artigos.show', $artigo->id) }}" class="text-decoration-none text-reset">{{ $artigo->titulo }}</a></td>
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
