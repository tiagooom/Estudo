<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Artigo;
use App\Models\Comentario;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        Artigo::factory(10)->create();
        Comentario::factory(20)->create();
    }
}
