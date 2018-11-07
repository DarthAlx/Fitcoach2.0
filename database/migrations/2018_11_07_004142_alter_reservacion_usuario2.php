<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReservacionUsuario2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('reservacion_usuarios', function (Blueprint $table) {
			$table->boolean('reserva')->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reservacion_usuarios', function (Blueprint $table) {
			$table->dropColumn('reserva');
		});
	}
}
