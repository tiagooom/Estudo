@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Editar Categoria</h1>
        <form action="/categorias/{{ $categoria->id }}" method="POST">
            <!-- Token CSRF e método PUT para atualização -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')

            <!-- Campo para o nome da categoria -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input
                    type="text"
                    class="form-control @error('nome') is-invalid @enderror"
                    id="nome"
                    name="nome"
                    placeholder="Digite o nome da categoria"
                    value="{{ old('nome', $categoria->nome) }}"
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
