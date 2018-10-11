<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionUsuariosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservacion_usuarios', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('reservacion_id');
			$table->integer('usuario_id');
			$table->boolean('asistencia')->defaults(false);
			$table->string('metadata');
			$table->string('estado');
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
		Schema::drop('reservacion_usuarios');
	}
}
