@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold">{{ $artigo->titulo }}</h1>
        <p class="text-gray-600">{{ $artigo->corpo }}</p>
        <p class="text-gray-500 text-sm">Publicado em: {{ $artigo->created_at->format('d/m/Y H:i') }}</p>

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

    // Função para carregar comentários via AJAX
    function carregarComentarios() {
        fetch(`/artigos/${artigoId}/comentarios`)
            .then(response => response.json())
            .then(data => {
                let comentariosHtml = '';
                data.forEach(comentario => {
                    comentariosHtml += `
                        <div class="bg-gray-100 p-3 my-2 rounded">
                            <p>${comentario.conteudo}</p>
                            <small class="text-gray-500">
                                ${new Date(comentario.created_at).getDate().toString().padStart(2, '0')}/${(new Date(comentario.created_at).getMonth() + 1).toString().padStart(2, '0')}/${new Date(comentario.created_at).getFullYear()} 
                                ${new Date(comentario.created_at).getHours().toString().padStart(2, '0')}:${new Date(comentario.created_at).getMinutes().toString().padStart(2, '0')}
                                Por: ${comentario.user.name}
                            </small>
                            <button onclick="removerComentario(${comentario.id})" class="btn btn-danger rounded-pill px-3 ms-2">Excluir</button>
                        </div>
                    `;
                });
                document.getElementById('lista-comentarios').innerHTML = comentariosHtml;
            });
    }


    // Enviar novo comentário via AJAX
    document.getElementById("form-comentario").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(`/comentarios`, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("comentario").value = "";
                carregarComentarios(); // Recarregar a lista de comentários
            } else {
                alert("Erro ao adicionar comentário!");
            }
        });
    });

    // Função para excluir comentário via AJAX
    window.removerComentario = function (id) {
        if (confirm("Deseja realmente excluir este comentário?")) {
            fetch(`/comentarios/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    carregarComentarios(); // Atualizar a lista de comentários
                } else {
                    alert("Erro ao excluir comentário!");
                }
            });
        }
    };

    // Carregar comentários ao abrir a página
    carregarComentarios();
});
</script>
@endsection
