<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');

            $table->integer('id_cita');

            $table->decimal('monto', 10, 2);
            $table->string('metodo')->nullable();
            $table->timestamp('fecha_pago')->useCurrent();

            $table->timestamps();

            $table->foreign('id_cita')
                ->references('id_cita')
                ->on('citas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
