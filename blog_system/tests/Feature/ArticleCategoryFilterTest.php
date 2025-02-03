<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Artigo;
use App\Models\Categoria;

class ArticleCategoryFilterTest extends TestCase
{
    public function test_filter_by_category()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $categoria = Categoria::factory()->create(['nome' => 'Categoria Teste']);

    Artigo::factory()->create([
        'titulo' => 'Artigo de Teste',
        'corpo' => 'Conteúdo do artigo',
        'categoria_id' => $categoria->id,
    ]);

    // Fazendo a requisição para filtrar pelo ID da categoria criada
    $response = $this->get("artigos/search?categoria={$categoria->id}");

    // Verificando se a página carrega corretamente
    $response->assertStatus(200);
    $response->assertSee('Artigo de Teste');

    // Verificando o filtro por titulo e conteudo
    $response = $this->get('/artigos/search?titulo=teste');
    $response->assertStatus(200);
    $response->assertSee('Artigo de Teste');

}


}
