<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TarjetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tarjetas', function (Blueprint $table) {
        $table->increments('id');
        $table->string('identificador');
        $table->string('num');
        $table->string('mes');
        $table->string('año');
        $table->string('nombre');
        $table->integer('user_id');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tarjetas');
    }
}
