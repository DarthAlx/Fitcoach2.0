<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha'); 
            $table->string('hora'); 
            $table->bigInteger('user_id'); 
            $table->string('recurrencia')->nullable();
            $table->integer('zona_id')->nullable();
            $table->integer('clase_id')->nullable(); 
            $table->integer('grupo_id')->nullable();
            $table->string('tipo')->nullable();
            $table->string('audiencia')->nullable();
            $table->integer('cupo')->nullable();
            $table->integer('ocupados')->nullable();
            $table->integer('tokens')->nullable();
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
        Schema::drop('horarios');
    }
}
