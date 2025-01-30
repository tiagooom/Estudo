<?php

// app/Http/Controllers/ComentarioController.php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Artigo;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Mostrar todos os comentários de um artigo específico
    public function index($artigoId)
    {
        $comentarios = Comentario::where('artigo_id', $artigoId)->get();
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

        // Criar o novo comentário
        $comentario = Comentario::create([
            'conteudo' => $request->conteudo,
            'artigo_id' => $request->artigo_id,
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

        if ($comentario) {
            $comentario->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Comentário não encontrado']);
    }
}

