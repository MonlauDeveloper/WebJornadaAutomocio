<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Migraciones deshabilitadas temporalmente - tabla projects no existe
        // Schema::create('students', function (Blueprint $table) {
        //     $table->id('idStudent'); // Cambiar el nombre del campo a 'idStudent'
        //     $table->string('name');
        //     $table->string('surname1');
        //     $table->string('surname2');
        //     $table->string('photoName')->nullable();
        //     $table->string('cvLink')->nullable();
        //     $table->boolean('isTeamLeader')->default(false); // Indica si es el líder del proyecto
        //     $table->unsignedBigInteger('idProject'); // Relación con el proyecto
        //     $table->foreign('idProject')->references('idProject')->on('projects')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }
    
    public function down()
    {
        Schema::dropIfExists('students');
    }
    
};
