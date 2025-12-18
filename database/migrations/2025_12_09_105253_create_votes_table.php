<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            
            // El identificador del móvil (UUID o lo que generes en Flutter)
            $table->string('device_token')->index(); 
            
            // Relación con el proyecto
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            
            $table->timestamps();

            // REGLA DE ORO: Un dispositivo no puede tener 2 filas para el mismo proyecto
            $table->unique(['device_token', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};