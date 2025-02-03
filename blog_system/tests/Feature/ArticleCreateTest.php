<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Categoria;
use Tests\TestCase;

class ArticleCreateTest extends TestCase
{
    public function test_create_article_page_is_inaccessible_to_guests()
    {
        $response = $this->get('/artigos/create');
        $response->assertRedirect('/login'); 
    }

    public function test_user_can_create_article()
    {
        $user = User::factory()->create();

        $categoria = Categoria::factory()->create();

        $response = $this->actingAs($user)->post('/artigos', [
            'titulo' => 'Test Article',
            'corpo' => 'Test content',
            'categoria_id' => $categoria->id, 
        ]);
    
        $response->assertStatus(302); // Verifica se foi redirecionado

        $this->assertDatabaseHas('artigos', [
            'titulo' => 'Test Article',
            'corpo' => 'Test content',
            'categoria_id' => $categoria->id, 
        ]);
    }
}
