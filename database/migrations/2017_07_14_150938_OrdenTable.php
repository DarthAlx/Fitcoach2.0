<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ordenes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('order_id');
          $table->integer('user_id');
          $table->integer('coach_id');
          $table->string('nombre');
          $table->date('fecha');
          $table->string('hora');
          $table->string('cantidad');
          $table->string('metadata');
          $table->string('status');
          $table->string('estado');
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
      Schema::drop('ordenes');
    }
}
