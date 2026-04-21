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
    Schema::table('companies', function (Blueprint $table) {
        // Esto le dice a la base de datos que ahora puede ser NULL
        $table->string('companyWeb')->nullable()->change();
    });
}

public function down()
{
    Schema::table('companies', function (Blueprint $table) {
        // Por si alguna vez quieres volver atrás, lo vuelve a hacer obligatorio
        $table->string('companyWeb')->nullable(false)->change();
    });
}
};
