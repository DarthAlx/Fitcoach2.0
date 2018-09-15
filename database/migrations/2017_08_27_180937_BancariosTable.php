<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('bancarios', function (Blueprint $table) {
        $table->increments('id');
        $table->string('banco');
        $table->string('cta');
        $table->string('clabe');
        $table->string('tarjeta');
        $table->string('adicional');
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
        Schema::drop('bancarios');
    }
}
