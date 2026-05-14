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
        Schema::create('resenas', function (Blueprint $table) {
            $table->id('id_resena');
            $table->integer('id_cita');
            $table->foreign('id_cita')
                ->references('id_cita')
                ->on('citas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_barbero');
            $table->tinyInteger('cal_citacion')->between(1, 5);  
            $table->tinyInteger('cal_trato')->between(1, 5);     
            $table->tinyInteger('cal_resultado')->between(1, 5); 
            $table->decimal('promedio', 3, 2)->storedAs('(cal_citacion + cal_trato + cal_resultado) / 3');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->unique('id_cita'); 
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_barbero')->references('id_barbero')->on('barberos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
