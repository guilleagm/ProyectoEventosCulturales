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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido')->nullable(false);
            $table->integer('valoracion')->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_evento')->nullable(false);

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_evento')->references('id')->on('eventos');

            $table->index('id_evento');
            $table->index('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
