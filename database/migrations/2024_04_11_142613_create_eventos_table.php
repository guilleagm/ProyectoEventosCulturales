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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50)->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->string('categoria', 20)->nullable(false);
            $table->integer('num_entradas_disponibles')->nullable(false);
            $table->enum('estado', ['En preparación', 'Cancelado', 'Terminado'])->nullable(false);
            $table->unsignedBigInteger('id_sede')->nullable();

            $table->foreign('id_sede')->references('id')->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
