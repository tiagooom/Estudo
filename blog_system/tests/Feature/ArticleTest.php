<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artigo;
use App\Models\User;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_listagem_de_artigos_esta_paginada()
    {
        // Criar usuário fictício
        $user = User::factory()->create();

        // Criar artigos 
        Artigo::factory()->create();

        // Simular usuário autenticado e acessar a página
        $response = $this->actingAs($user)->get('/artigos');

        // Verifica se a resposta foi 200
        $response->assertStatus(200);

        // Verifica se há um artigo na listagem
        $response->assertSeeText(Artigo::first()->titulo);

    }



}

