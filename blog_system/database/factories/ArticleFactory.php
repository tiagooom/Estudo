<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Gera um título fictício
            'content' => $this->faker->paragraph(5), // Gera 5 frases fictícias
            'category_id' => Category::factory(), // Associa o artigo a uma categoria
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
