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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presentation_id');
            $table->string('userName'); // Nombre real o "InvitadoXXX"
            $table->text('content');
            $table->boolean('isValidated')->default(false); // Para moderación
            $table->boolean('isRejected')->default(false);  // Para rechazos
            $table->boolean('isTeacher')->default(false);   // Para resaltar profes
            $table->timestamps();

            // Opcional: Relación con ponencias si tienes la tabla
            // $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
