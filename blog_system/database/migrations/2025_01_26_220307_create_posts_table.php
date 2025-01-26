<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ID auto-incremento
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relação com o usuário (autor do post)
            $table->string('title'); // Título do post
            $table->text('content'); // Conteúdo do post
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
        Schema::dropIfExists('posts');
    }
}
