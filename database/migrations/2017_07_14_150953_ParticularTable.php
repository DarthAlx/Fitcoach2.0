<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParticularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('particulares', function (Blueprint $table) {
          $table->increments('id');
          $table->date('fecha');
          $table->string('hora');
          $table->integer('user_id');
          $table->integer('clase_id');
          $table->string('recurrencia');
          $table->integer('zona_id');
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
        Schema::drop('particulares');
    }
}
