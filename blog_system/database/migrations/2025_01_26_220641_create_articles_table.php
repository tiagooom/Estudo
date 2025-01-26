<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // ID do artigo
            $table->string('title'); // Título do artigo
            $table->text('content'); // Conteúdo do artigo
            $table->timestamp('published_at')->nullable(); // Data de publicação
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relação com categorias
            $table->timestamps(); // Criado em e atualizado em
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
