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
    Schema::table('muros', function (Blueprint $table) {
        $table->unsignedBigInteger('id_usuario')->after('id_muro');
        $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
    });
    }

    public function down()
    {
        Schema::table('muros', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });
    }
};
