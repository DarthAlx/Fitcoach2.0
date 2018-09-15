<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cupones', function (Blueprint $table) {
        $table->increments('id');
        $table->string('descripcion');
        $table->string('codigo');
        $table->integer('monto');
        $table->integer('usos');
        $table->integer('minimo');
        $table->date('expiracion');
        $table->integer('user_id');
        $table->integer('maximo');
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
        Schema::drop('cupones');
    }
}
