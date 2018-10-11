<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('reservaciones', function (Blueprint $table) {
			$table->dateTime('inicio')->nullable();
			$table->dateTime('fin')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reservaciones', function (Blueprint $table) {
			$table->dropColumn('inicio');
			$table->dropColumn('fin');
		});
	}
}
