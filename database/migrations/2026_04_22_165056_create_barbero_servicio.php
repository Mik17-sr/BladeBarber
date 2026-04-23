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
        Schema::create('barbero_servicio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_barbero');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_barbero')
                ->references('id_barbero')
                ->on('barberos')
                ->onDelete('cascade');
            $table->foreign('id_servicio')
                ->references('id_servicio')
                ->on('servicios')
                ->onDelete('cascade');
            $table->primary(['id_barbero', 'id_servicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbero_servicio');
    }
};
