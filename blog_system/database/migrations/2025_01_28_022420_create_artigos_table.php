<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Título do artigo
            $table->text('corpo'); // Corpo do artigo
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->boolean('publicado')->default(false); // Artigo publicado ou não
            $table->timestamps();
        });
    }


    /**
     * Reverte a migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artigos');
    }
    
};
