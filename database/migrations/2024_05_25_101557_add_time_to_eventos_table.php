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
        Schema::table('eventos', function (Blueprint $table) {
            $table->time('hora')->nullable();  // Añade columna para la hora, nullable si la hora puede ser opcional
        });
    }

    public function down()
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn('hora');  // Elimina la columna en caso de rollback
        });
    }
};
