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
    Schema::create('project_images', function (Blueprint $table) {
        $table->id();

        // En lugar de foreignId, usamos esta forma que detecta el tipo de la tabla original
        $table->unsignedInteger('idProject'); 
        $table->foreign('idProject')
              ->references('idProject')
              ->on('projects')
              ->onDelete('cascade');

        $table->string('file_path');
        $table->string('fase');
        $table->integer('orden')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
