<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pagos', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->date('fecha');
        $table->string('metodo');
        $table->string('referencia');
        $table->string('monto');
        $table->string('deducciones');
        $table->string('ordenes');
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
        Schema::drop('pagos');
    }
}
