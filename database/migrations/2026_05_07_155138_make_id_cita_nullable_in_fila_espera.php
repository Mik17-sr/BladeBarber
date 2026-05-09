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
    Schema::table('fila_espera', function (Blueprint $table) {
        $table->dropForeign('fila_espera_id_cita_foreign');
        $table->integer('id_cita')->nullable()->change();
        $table->foreign('id_cita')->references('id_cita')->on('citas')->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('fila_espera', function (Blueprint $table) {
        $table->dropForeign('fila_espera_id_cita_foreign');
        $table->integer('id_cita')->nullable(false)->change();
        $table->foreign('id_cita')->references('id_cita')->on('citas');
    });
}
};
