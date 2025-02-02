@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
    <h1>Artigos</h1>

    <form action="{{ route('artigos.search') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <!-- Filtro por categoria -->
            <div class="col-md-4">
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
    
            <!-- Filtro por titulo ou conteudo -->
            <div class="col-md-6">
                <label for="search" class="form-label">Buscar em titulos e conteúdo</label>
                <div class="input-group">
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        class="form-control" 
                        placeholder="Digite o título ou conteúdo"
                        value="{{ request()->get('search') }}"
                    >
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
    </form>
    
    

    <!-- Botão para criar artigo -->
    <a href="{{ route('artigos.create') }}" class="btn btn-primary rounded-pill px-3 my-3">Criar Artigo</a>

    <!-- Verifica se não há artigos -->
    @if ($artigos->isEmpty())
        <p>Nenhum artigo encontrado.</p>
    @else
        <!-- Exibe os artigos -->
        @foreach ($artigos as $artigo)
            <a href="{{ route('artigos.show', $artigo->id) }}" class="text-decoration-none text-dark">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $artigo->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($artigo->corpo, 100) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
@endsection
