@extends('layouts.app')

@section('title', 'Criar Artigo')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Criar Artigo</h1>
        <form action="/artigos" method="POST">
        <!-- Token CSRF (se necessário em Laravel ou outras plataformas) -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Campo para o título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Artigo</label>
            <input 
            type="text" 
            class="form-control" 
            id="titulo" 
            name="titulo" 
            placeholder="Digite o título do artigo" 
            value="{{ old('titulo', $artigo->titulo ?? '') }}" 
            maxlength="255" 
            required>
        </div>

        <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
        <!-- Campo para o corpo do artigo -->
        <div class="mb-3">
            <label for="corpo" class="form-label">Conteúdo</label>
            <textarea 
            class="form-control" 
            id="corpo" 
            name="corpo" 
            rows="10" 
            placeholder="Digite o conteúdo do artigo" 
            required>{{ old('corpo', $artigo->corpo ?? '') }}</textarea>
        </div>

        <!-- Botões -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/artigos" class="btn btn-secondary">Voltar</a>
        </div>
        </form>
    </div>
@endsection
