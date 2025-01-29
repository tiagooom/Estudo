@extends('layouts.app')

@section('title', 'Editar Artigo')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Editar Artigo</h1>
        <form action="/artigos/{{ $artigo->id }}" method="POST">
        <!-- Token CSRF (se necessário em Laravel ou outras plataformas) -->
        @csrf
        @method('PUT')
        <!-- Campo para o título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Artigo</label>
            <input 
                type="text" 
                class="form-control @error('titulo') is-invalid @enderror" 
                id="titulo" 
                name="titulo" 
                placeholder="Digite o título do artigo" 
                value="{{ old('titulo', $artigo->titulo ?? '') }}" 
                maxlength="255" 
                required>
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>        

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select 
                class="form-select @error('categoria_id') is-invalid @enderror" 
                id="categoria_id" 
                name="categoria_id" 
                required>
                <option value="">Selecione uma categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        {{ old('categoria_id', $artigo->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        
        <!-- Campo para o corpo do artigo -->
        <div class="mb-3">
            <label for="corpo" class="form-label">Conteúdo</label>
            <textarea 
                class="form-control @error('corpo') is-invalid @enderror" 
                id="corpo" 
                name="corpo" 
                rows="10" 
                placeholder="Digite o conteúdo do artigo" 
                required>{{ old('corpo', $artigo->corpo ?? '') }}</textarea>
            @error('corpo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        
        <!-- Botões -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/artigos" class="btn btn-secondary">Voltar</a>
        </div>
        </form>
    </div>
@endsection
