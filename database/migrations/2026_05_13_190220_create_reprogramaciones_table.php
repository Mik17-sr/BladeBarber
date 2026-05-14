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
        Schema::create('reprogramaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cita');
            $table->foreign('id_cita')
                ->references('id_cita')
                ->on('citas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_barbero');
            $table->foreign('id_barbero')->references('id_barbero')->on('barberos');
            $table->dateTime('hora_original');
            $table->dateTime('hora_nueva');
            $table->string('motivo', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reprogramaciones');
    }
};
