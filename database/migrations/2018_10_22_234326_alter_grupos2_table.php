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
			$table->date('deleted_at')->nullable();
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
		    $table->dropColumn('deleted_at');
	    });
    }
}
