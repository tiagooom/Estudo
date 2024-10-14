<?php

namespace Database\Factories;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\User;
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
            'status' => $this->faker->randomElement(['Pendente', 'Em andamento', 'Finalizado']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Projeto $projeto) {
            // Associar um usuário aleatório à tabela projeto_user
            $usuarios = User::inRandomOrder()->take(3)->get(); // Pega 3 usuários aleatórios

            foreach ($usuarios as $usuario) {
                $projeto->usuarios()->attach($usuario->id); // Associa cada usuário ao projeto
                Tarefa::factory()->create([
                    'projeto_id' => $projeto->id,
                    'usuario_id' => $usuarios->random()->id // Associa a tarefa a um usuário aleatório entre os 3 do projeto
                ]);
            }
        });
    }
}
