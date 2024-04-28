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
        $tables = [
            'artistas',
            'asignacion_entradas',
            'comentarios',
            'eventos',
            'favoritos',
            'noticias',
            'programacion',
            'sedes',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'created_at') && !Schema::hasColumn($tableName, 'updated_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'artistas',
            'asignacion_entradas',
            'comentarios',
            'eventos',
            'favoritos',
            'noticias',
            'programacion',
            'sedes',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }
    }
};
