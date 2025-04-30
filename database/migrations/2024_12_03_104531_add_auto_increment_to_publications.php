<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoIncrementToPublications extends Migration
{/*
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            // Establecer el campo 'idPublication' como auto-incremental
            $table->increments('idPublication')->change();
        });
    }

    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->integer('idPublication')->change();  // Retirar auto-increment
        });
    }*/
}
