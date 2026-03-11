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
        Schema::create('cancellations', function (Blueprint $table) {
            $table->id(); // Crea un id autoincremental
            
            // Campos para guardar la info de la reserva borrada
            $table->integer('idTable');
            $table->integer('idStudent');
            $table->dateTime('reservation_time');
            
            // El motivo de la cancelación (puede ser nulo si no escriben nada)
            $table->text('reason')->nullable();
            
            // Fecha exacta de cuando se canceló
            $table->timestamp('cancelled_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellations');
    }
};