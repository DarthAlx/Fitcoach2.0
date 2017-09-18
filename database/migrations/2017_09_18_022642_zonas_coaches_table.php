<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZonasCoachesTable extends Migration
{

    public function up()
    {
      Schema::create('zonas_coaches', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('zona_id');
        $table->timestamps();
    });
    }

    public function down()
    {
          Schema::drop('zonas_coaches');
    }
}
