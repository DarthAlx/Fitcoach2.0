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
            $table->date('fecha');
            $table->string('hora');
            $table->string('nombre');
            $table->integer('clase_id');
            $table->integer('user_id');
            $table->string('tipo');
            $table->integer('condominio_id');
            $table->string('audiencia');
            $table->string('cupo');
            $table->string('ocupados');
            $table->integer('evento_id')->nullable('true');
            $table->longText('descripcion');
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
