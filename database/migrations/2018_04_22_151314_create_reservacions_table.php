<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('horario_id')->nullable(true);
            $table->bigInteger('grupo_id')->nullable(true);
            $table->bigInteger('user_id');
            $table->bigInteger('coach_id');
            $table->string('nombre');
            $table->string('tipo');
            $table->string('fecha');
            $table->string('hora');
            $table->longText('direccion');
            $table->string('aforo');
            $table->string('status');
            $table->string('metadata');
            $table->string('tokens');
            $table->longText('comentarios');
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
        Schema::drop('reservaciones');
    }
}
