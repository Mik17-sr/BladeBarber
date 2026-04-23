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
        Schema::create('agenda_servicio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_agenda');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_agenda')
                ->references('id_agenda')
                ->on('agendas')
                ->onDelete('cascade');
            $table->foreign('id_servicio')
                ->references('id_servicio')
                ->on('servicios')
                ->onDelete('cascade');
            $table->primary(['id_agenda', 'id_servicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_servicio');
    }
};
