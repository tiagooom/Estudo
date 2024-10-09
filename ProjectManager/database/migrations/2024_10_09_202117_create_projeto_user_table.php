<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projeto_user', function (Blueprint $table) {
            $table->id(); // Campo ID
            $table->foreignId('projeto_id')->constrained()->onDelete('cascade'); // Referência ao projeto
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referência ao usuário
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeto_user');
    }
};
