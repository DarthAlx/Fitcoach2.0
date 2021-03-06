<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cuponera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cuponera', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('cupon_id');
        $table->integer('user_id');
        $table->string('orden_id');
        $table->string('descripcion');
        $table->string('codigo');
        $table->string('monto');
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
        Schema::drop('cuponera');
    }
}
