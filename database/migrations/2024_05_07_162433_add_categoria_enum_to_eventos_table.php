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
            // Add a new enum column for categories
            $table->enum('categoria', ['concierto', 'teatro', 'recital de poesía'])
                ->default('concierto')
                ->after('titulo');
        });
    }

    public function down()
    {
        Schema::table('eventos', function (Blueprint $table) {
            // Remove the categoria column when rolling back
            $table->dropColumn('categoria');
        });
    }
};
