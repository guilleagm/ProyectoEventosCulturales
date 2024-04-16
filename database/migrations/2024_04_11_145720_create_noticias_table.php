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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->text('texto')->nullable(false);
            $table->unsignedBigInteger('id_artista')->nullable(false);
            $table->unsignedBigInteger('id_usuario')->nullable(false);

            $table->foreign('id_artista')->references('id')->on('artistas');
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->index('id_artista');
            $table->index('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
