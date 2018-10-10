<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('planes', function (Blueprint $table) {
			$table->string('tipo')->nullable();
			$table->integer('item_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planes', function (Blueprint $table) {
			$table->dropColumn('tipo');
			$table->dropColumn('item_id');
		});
	}
}
