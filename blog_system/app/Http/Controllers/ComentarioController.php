<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para acessar o usuário logado
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ComentarioController extends Controller
{
    use AuthorizesRequests;
    // Mostrar todos os comentários de um artigo específico
    public function index($artigoId)
    {
        $comentarios = Comentario::with('user')->where('artigo_id', $artigoId)->get();
        return response()->json($comentarios);
    }

    // Armazenar um novo comentário
    public function store(Request $request)
    {
        // Validação do comentário
        $request->validate([
            'conteudo' => 'required|string',
            'artigo_id' => 'required|exists:artigos,id',
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        // Obter o usuário logado
        $user = Auth::user();

        // Criar o novo comentário com o usuário logado
        $comentario = Comentario::create([
            'conteudo' => $request->conteudo,
            'artigo_id' => $request->artigo_id,
            'user_id' => $user->id, // Associando o comentário ao usuário logado
        ]);

        // Retornar uma resposta com o comentário criado
        return response()->json([
            'success' => true,
            'comentario' => $comentario,
        ]);
    }

    // Excluir um comentário
    public function destroy($id)
    {
        $comentario = Comentario::find($id);
        
        $this->authorize('delete', $comentario);

        if (!$comentario) {
            return response()->json(['success' => false, 'message' => 'Comentário não encontrado'], 404);
        }

        if ($comentario) {
            $comentario->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Comentário não encontrado']);
    }
}
