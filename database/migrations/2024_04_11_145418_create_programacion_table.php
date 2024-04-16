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
        Schema::create('programacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_artista');
            $table->dateTime('fecha_hora')->nullable(false);

            $table->foreign('id_evento')->references('id')->on('eventos');
            $table->foreign('id_artista')->references('id')->on('artistas');

            $table->index('id_artista');
            $table->index('id_evento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programacion');
    }
};
