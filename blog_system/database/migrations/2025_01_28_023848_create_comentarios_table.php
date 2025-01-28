<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->text('conteudo'); // Conteúdo do comentário
            $table->foreignId('artigo_id')->constrained()->onDelete('cascade'); // Chave estrangeira para Artigo
            $table->timestamps(); // Timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
