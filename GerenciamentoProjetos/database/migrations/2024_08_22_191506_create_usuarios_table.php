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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Campo ID auto-incrementável
            $table->string('nome'); // Campo para o nome do usuário
            $table->string('email')->unique(); // Campo para o e-mail do usuário, deve ser único
            $table->string('password'); // Campo para a senha do usuário
            $table->rememberToken(); // Campo para token de lembrança (usado para sessões)
            $table->timestamps(); // Campos de timestamp (created_at e updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
