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
    if (!Schema::hasTable('detalle_reservas')) {
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('plato_id');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->timestamps();

            $table->foreign('reserva_id')->references('reserva_id')->on('reservas')->onDelete('cascade');
            $table->foreign('plato_id')->references('id_plato')->on('platos')->onDelete('restrict');
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_reservas');
    }
};
