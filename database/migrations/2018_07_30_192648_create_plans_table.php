<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('inicio');
            $table->longText('medular');
            $table->longText('final');
            $table->string('minutosinicio');
            $table->string('minutosmedular');
            $table->string('minutosfinal');
            $table->longText('comentarios');
            $table->bigInteger('reservacion_id');
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
        Schema::drop('planes');
    }
}
