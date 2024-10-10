<?php

namespace Database\Factories;

use App\Models\Projeto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'descricao' => $this->faker->paragraph,
            'data_inicio' => $this->faker->date(),
            'data_fim' => $this->faker->date(),
            'status' => 'Pendente',
            'projeto_id' => Projeto::inRandomOrder()->first()->id,
            'usuario_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
