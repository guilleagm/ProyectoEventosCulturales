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
            // Add the id_usuario column with an appropriate data type
            $table->unsignedBigInteger('id_usuario')->nullable()->after('id');

            // Optionally, add a foreign key constraint to ensure data integrity
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('eventos', function (Blueprint $table) {
            // Drop the foreign key constraint first, then the column
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });
    }
};
