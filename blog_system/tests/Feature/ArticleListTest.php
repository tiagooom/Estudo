<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Artigo;

class ArticleListTest extends TestCase
{
    public function test_article_list_is_paginated()
    {
        $user = User::factory()->create();

        Artigo::factory(15)->create();

        $response = $this->actingAs($user)->get('/artigos');
        $response->assertStatus(200);
        $response->assertSee('page-item');
    }
}
