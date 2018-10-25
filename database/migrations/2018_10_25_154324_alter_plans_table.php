<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planes', function (Blueprint $table) {
            $table->longText('objetivos');
            $table->longText('materiales');
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
            $table->dropColumn('objetivos');
            $table->dropColumn('materiales');
        });
    }
}
