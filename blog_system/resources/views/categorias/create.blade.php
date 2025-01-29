@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Criar Categoria</h1>
        <form action="/categorias" method="POST">
            <!-- Token CSRF -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Campo para o nome da categoria -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input
                    type="text"
                    class="form-control @error('nome') is-invalid @enderror"
                    id="nome"
                    name="nome"
                    placeholder="Digite o nome da categoria"
                    value="{{ old('nome') }}"
                    maxlength="255"
                    required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="/categorias" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
