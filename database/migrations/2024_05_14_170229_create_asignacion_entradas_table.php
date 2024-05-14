<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asignacion_entradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_evento')
                ->constrained('eventos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('id_usuario')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('num_entradas_asignadas');
            $table->timestamps();

            // Añadir una restricción de clave única para la combinación de id_evento y id_usuario
            $table->unique(['id_evento', 'id_usuario'], 'evento_usuario_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_entradas');
    }
};
