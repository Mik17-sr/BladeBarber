<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('novedades_disponibilidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barbero');
            $table->foreign('id_barbero')
                  ->references('id_barbero')
                  ->on('barberos')
                  ->onDelete('cascade');
            $table->date('fecha');
            $table->enum('tipo', ['inasistencia', 'cancelacion_anticipada', 'otro']);
            $table->string('motivo', 600);
            $table->time('hora_afectada')->nullable();
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])
                  ->default('pendiente');
            $table->unsignedBigInteger('aprobado_por')->nullable();
 
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('novedades_disponibilidad');
    }
};