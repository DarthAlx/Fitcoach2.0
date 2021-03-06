<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password', 60);
        $table->enum('role',['usuario', 'instructor', 'admin', 'superadmin', 'banned'])->default('usuario');
        $table->string('dob');
        $table->string('tel',10);
        $table->string('genero');
        $table->integer('rating')->nullable(true);
        $table->date('acceso')->default(date('Y-m-d'));
        $table->string('code');
        $table->string('referencia')->nullable(true);
        $table->boolean('editor')->default(false);
        $table->rememberToken();
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
        Schema::drop('users');
    }
}
