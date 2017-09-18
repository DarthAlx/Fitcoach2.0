<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('photo');
        $table->string('tel');
        $table->string('intereses');
        $table->string('permisos');
        $table->string('rfc');
        $table->string('clases');
        $table->string('zonas');
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
      Schema::drop('detalles');
    }
}
