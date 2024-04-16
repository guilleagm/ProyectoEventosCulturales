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
        Schema::create('asignacion_entradas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_usuario');
            $table->integer('num_entradas_asignadas');

            $table->primary('id_evento');
            $table->foreign('id_evento')->references('id')->on('eventos');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_entradas');
    }
};
