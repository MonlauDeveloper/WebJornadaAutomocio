<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('company_tables'); // Limpieza preventiva

        Schema::create('company_tables', function (Blueprint $table) {
            $table->id('idTable'); 
            $table->string('tableName');

            // --- CORRECCIÓN FINAL ---
            // Como tu tabla original es int(11) (con signo), usamos integer() normal.
            $table->integer('idCompany'); 
            // ------------------------

            $table->foreign('idCompany')
                  ->references('idCompany')
                  ->on('companies')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_tables');
    }
};