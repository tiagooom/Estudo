<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projeto>
 */
class ProjetoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->text(50), 
            'descricao' => $this->faker->paragraph, 
            'data_inicio' => $this->faker->dateTimeBetween('now', '+1 week'), 
            'data_fim' => $this->faker->dateTimeBetween('now', '+1 month'), 
            'status' => 'Em andamento', // Um status fictício
        ];
    }
}
