<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGrupos2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('grupos', function (Blueprint $table) {
			$table->string('audiencia',100)->nullable()->change();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('grupos', function (Blueprint $table) {
	    });
    }
}
