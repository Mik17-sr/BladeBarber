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
        Schema::create('configuracion_fila', function (Blueprint $table) {
        $table->id('id_config');
        $table->dateTime('fecha_inicio');
        $table->dateTime('fecha_fin');
        $table->boolean('activa')->default(false);
        $table->unsignedInteger('intervalo_atencion')->default(30); // minutos
        $table->timestamps();
        });

        // database/migrations/xxxx_create_fila_espera_table.php
        Schema::create('fila_espera', function (Blueprint $table) {
            $table->id('id_turno');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente');
            $table->foreignId('id_barbero')->nullable()->constrained('barberos', 'id_barbero');
            $table->integer('id_cita');
            $table->foreign('id_cita')
                ->references('id_cita')
                ->on('citas')
                ->onDelete('cascade');
            $table->unsignedInteger('posicion');
            $table->enum('estado', ['esperando', 'asignado', 'en_atencion', 'completado', 'cancelado', 'no_se_presento'])
                ->default('esperando');
            $table->timestamps();
        });

        // Pivot servicios
        Schema::create('fila_espera_servicios', function (Blueprint $table) {
            $table->foreignId('id_turno')->constrained('fila_espera', 'id_turno')->cascadeOnDelete();
            $table->foreignId('id_servicio')->constrained('servicios', 'id_servicio');
            $table->primary(['id_turno', 'id_servicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fila_tablas');
    }
};
