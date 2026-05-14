<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bloques_almuerzo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barbero');
            $table->foreign('id_barbero')
                  ->references('id_barbero')
                  ->on('barberos')
                  ->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('automatico')->default(false);
            $table->unsignedBigInteger('id_cita_origen')->nullable();
            $table->timestamps();
            $table->unique(['id_barbero', 'fecha']);
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('bloques_almuerzo');
    }
};