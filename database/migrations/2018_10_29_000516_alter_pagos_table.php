<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('pagos', function (Blueprint $table) {
			$table->string('iva')->default('0');
			$table->string('factura')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagos', function (Blueprint $table) {
			$table->dropColumn('iva');
			$table->dropColumn('factura');
		});
	}
}
