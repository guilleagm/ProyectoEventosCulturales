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
        Schema::create('usuario_artista_favorito', function (Blueprint $table) {
            $table->foreignId('id_usuario')
                ->constrained('users')
                ->onDelete('cascade')
                ->references('id')
                ->on('users');

            $table->foreignId('id_artista')
                ->constrained('artistas')
                ->onDelete('cascade')
                ->references('id')
                ->on('artistas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_artista_favorito');
    }
};
