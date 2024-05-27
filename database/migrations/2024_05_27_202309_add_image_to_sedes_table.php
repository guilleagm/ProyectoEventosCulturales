<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->string('imagen')->nullable(); // Añade la columna imagen que puede ser nula
        });
    }

    public function down()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->dropColumn('imagen'); // Elimina la columna en caso de revertir la migración
        });
    }
};
