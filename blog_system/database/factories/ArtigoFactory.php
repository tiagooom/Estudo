<?php

namespace Database\Factories;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtigoFactory extends Factory
{
    protected $model = Artigo::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence, // Gera um título fictício
            'corpo' => $this->faker->paragraph(5), // Gera 5 frases fictícias
            'categoria_id' => Categoria::factory(), // Associa o artigo a uma categoria
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
