<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoIncrementToDynamicTestings extends Migration
{/*
    public function up()
    {
        Schema::table('dynamicTestings', function (Blueprint $table) {
            // Establecer la columna como auto-incrementable
            $table->increments('idDynamicTesting')->change();
        });
    }

    public function down()
    {
        Schema::table('dynamicTestings', function (Blueprint $table) {
            $table->integer('idDynamicTesting')->change();  // Retirar el auto-increment
        });
    }*/
}
