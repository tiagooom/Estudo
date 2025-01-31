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

    @if ($artigos->isEmpty())
        <p>Nenhum artigo encontrado.</p>
    @else
        @foreach ($artigos as $artigo)
            <a href="{{ route('artigos.show', $artigo->id) }}" class="text-decoration-none text-dark">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $artigo->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($artigo->corpo, 100) }}</p>
                    </div>
                </div>
                @endforeach
            </a>
    @endif
@endsection
