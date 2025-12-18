<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id('idSlot');
            
            // 1. SOLO Hora de inicio (Fecha y Hora)
            $table->dateTime('start_time'); 
            
            // 2. Relación con la Mesa (company_tables)
            $table->unsignedBigInteger('idTable');
            
            $table->foreign('idTable')
                  ->references('idTable')
                  ->on('company_tables')
                  ->onDelete('cascade');

            // 3. Relación con el Alumno (Nullable = Hueco libre)
            // Usamos 'integer' porque es lo más probable según tu base de datos antigua
            $table->integer('idStudent')->nullable(); 

            // Opcional: Descomenta esta línea SOLO si estás seguro que el idStudent coincide
            // $table->foreign('idStudent')->references('idStudent')->on('students');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};