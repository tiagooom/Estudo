<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Artigo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition()
    {
        return [
            'artigo_id' => Artigo::factory(), // Criando um artigo para o comentário (se você tiver artigos)
            'conteudo' => $this->faker->paragraph, // Gerando um parágrafo de conteúdo
            'user_id' => User::factory()
        ];
    }
}

