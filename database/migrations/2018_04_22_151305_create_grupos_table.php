<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->bigInteger('condominio_id');
            $table->bigInteger('room_id');
            $table->longText('descripcion');
            $table->bigInteger('user_id');
            $table->bigInteger('clase_id');
            $table->integer('audiencia');
            $table->integer('cupo');
            $table->integer('tokens');
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
        Schema::drop('grupos');
    }
}
