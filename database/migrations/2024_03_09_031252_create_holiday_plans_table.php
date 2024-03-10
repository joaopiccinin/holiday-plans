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
        Schema::create('holiday_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Coluna para o título do plano de feriado
            $table->text('description'); // Coluna para a descrição do plano de feriado
            $table->date('date'); // Coluna para a data do plano de feriado
            $table->string('location'); // Coluna para a localização do plano de feriado
            $table->integer('participants')->nullable(); // Coluna para o número de participantes do plano de feriado (opcional)
            $table->timestamps(); // Colunas de timestamps padrão do Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holiday_plans');
    }
};
