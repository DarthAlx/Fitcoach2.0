<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('direcciones', function (Blueprint $table) {
          $table->increments('id');
          $table->string('identificador');
          $table->string('calle');
          $table->string('numero_ext');
          $table->string('numero_int');
          $table->string('colonia');
          $table->string('municipio_del');
          $table->string('cp');
          $table->string('estado');
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
      Schema::drop('direcciones');
    }
}
