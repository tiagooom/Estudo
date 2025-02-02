@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold">{{ $artigo->titulo }}</h1>
        <p class="text-gray-600">{{ $artigo->corpo }}</p>
        <p class="text-gray-500 text-sm">Publicado em: {{ $artigo->created_at->format('d/m/Y H:i') }}</p>
        
        <div class="mt-4 flex gap-2">
            @can('update', $artigo)
            <a href="{{ route('artigos.edit', $artigo->id) }}" class="btn btn-secondary rounded-pill px-3">Editar</a>
            <form action="{{ route('artigos.destroy', $artigo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-pill px-3">Deletar</button>
            </form>
            @endcan
        </div>

        <hr class="my-4">

        <!-- Seção de Comentários -->
        <h2 class="text-xl font-bold">Comentários</h2>

        <!-- Formulário de Novo Comentário -->
        <form id="form-comentario" class="mt-4">
            @csrf
            <input type="hidden" name="artigo_id" value="{{ $artigo->id }}">
            <textarea id="comentario" name="conteudo" class="form-control w-75" placeholder="Escreva um comentário..."></textarea>
            <div class="d-flex mt-2 mb-4">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>

        @push('styles')
            <!-- Carregar Bootstrap Icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        @endpush

        <!-- Lista de Comentários -->
        <div id="lista-comentarios" class="mt-6">
            <!-- Comentários serão carregados via AJAX -->
        </div>
    </div>
</div>

<!-- Script AJAX -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let artigoId = {{ $artigo->id }};
    const user_id = {{ auth()->id() }};
    let user_role = @json(auth()->user()->role);

    function carregarComentarios() {
        fetch(`/artigos/${artigoId}/comentarios`)
            .then(response => response.json())
            .then(data => {
                let comentariosHtml = '';
                
                data.forEach(comentario => {
                    debugger;
                    comentariosHtml += `
                        <div class="bg-gray-100 p-3 my-2 rounded">
                            <p>${comentario.conteudo}</p>
                            <small class="text-gray-500">
                                ${new Date(comentario.created_at).toLocaleDateString()} 
                                ${new Date(comentario.created_at).toLocaleTimeString()} 
                                Por: ${comentario.user.name}
                            </small>

                            ${user_id === comentario.user_id || user_role === 'admin' ? `
                                <button onclick="removerComentario(${comentario.id})" class="p-0 border-0">
                                    <i class="bi bi-trash"></i>
                                </button>
                            ` : ''}

                        </div>
                    `;
                });
                document.getElementById('lista-comentarios').innerHTML = comentariosHtml;
            });
    }

    document.getElementById("form-comentario").addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        fetch(`/comentarios`, {
            method: "POST",
            body: formData,
            headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("comentario").value = "";
                carregarComentarios();
            } else {
                alert(data.error || "Erro ao adicionar comentário!");
            }
        });
    });

    window.removerComentario = function (id) {
        if (confirm("Deseja realmente excluir este comentário?")) {
            fetch(`/comentarios/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    carregarComentarios();
                } else {
                    alert("Erro ao excluir comentário!");
                }
            });
        }
    };

    carregarComentarios();
});
</script>
@endsection
