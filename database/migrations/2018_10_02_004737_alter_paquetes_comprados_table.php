<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPaquetesCompradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('paquetescomprados', function (Blueprint $table) {
		    $table->string('comentario')->nullable();
		    $table->integer('usados')->default(0);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('paquetescomprados', function (Blueprint $table) {
		    $table->dropColumn('comentario');
		    $table->dropColumn('usados');
	    });
    }
}
