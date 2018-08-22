<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->longText('direccion');
            $table->string('imagen');
            $table->date('fecha');
            $table->string('hora');
            $table->longText('descripcion');
            $table->bigInteger('condominio_id');
            $table->string('precio');
            $table->integer('cupo');
            $table->integer('ocupados');
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
        Schema::drop('eventos');
    }
}
