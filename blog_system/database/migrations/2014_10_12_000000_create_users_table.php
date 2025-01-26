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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID do usuário
            $table->string('name'); // Nome do usuário
            $table->string('email')->unique(); // E-mail único
            $table->timestamp('email_verified_at')->nullable(); // E-mail verificado
            $table->string('password'); // Senha (hashing automático pelo Laravel)
            $table->enum('role', ['user', 'admin'])->default('user'); // Função do usuário (comum ou admin)
            $table->rememberToken(); // Token para lembrar do login
            $table->timestamps(); // Criado em e atualizado em
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
