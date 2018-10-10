<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('evento_reservaciones', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('evento_id')->nullable()->unsigned();
		    $table->integer('user_id')->nullable()->unsigned();
		    $table->string('valor_pagado');
		    $table->enum('estado',['COMPLETA','PROXIMA','CANCELADO']);
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
	    Schema::drop('evento_reservaciones');
    }
}
