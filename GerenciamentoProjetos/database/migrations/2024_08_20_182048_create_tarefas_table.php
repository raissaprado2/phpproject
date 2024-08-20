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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
Schema::create('tarefas', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->text('descricao')->nullable();
    $table->enum('prioridade', ['Baixa', 'Média', 'Alta']);
    $table->enum('status', ['Pendente', 'Em Progresso', 'Concluída']);
    $table->date('data_vencimento');
    $table->foreignId('projeto_id')->constrained()->onDelete('cascade');
    $table->foreignId('responsavel_id')->constrained('users');
    $table->timestamps();
});

