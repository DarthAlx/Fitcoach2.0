<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('condominio_id')->nullable()->unsigned()->index('fk_users_condominios_idx');
            $table->foreign('condominio_id', 'fk_users_condominios_idx')->references('id')->on('condominios')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn('condominio_id');
            $table->dropForeign('condominio_id');
        });
    }
}
