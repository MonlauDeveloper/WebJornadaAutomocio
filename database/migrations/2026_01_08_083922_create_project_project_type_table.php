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
        Schema::create('project_project_type', function (Blueprint $table) {
            $table->id();
        
            // --- CAMBIO IMPORTANTE AQUÍ ---
            // Cambiamos 'unsignedBigInteger' por 'unsignedInteger' para que coincida con tu tabla projects
            $table->unsignedInteger('idProject'); 
        
            // Este lo dejamos en BigInteger porque la tabla project_types es nueva y usa BigInt
            $table->unsignedBigInteger('idProjectType');

            // Definimos las relaciones
            $table->foreign('idProject')->references('idProject')->on('projects')->onDelete('cascade');
            $table->foreign('idProjectType')->references('idProjectType')->on('project_types')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_project_type');
    }
};
