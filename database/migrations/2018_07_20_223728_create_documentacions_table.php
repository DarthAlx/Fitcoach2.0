<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacion', function (Blueprint $table) {
            $table->increments('id');

            $table->string('rfc');
            $table->string('ine');
            $table->string('curp');
            $table->string('acta');
            $table->string('domicilio');
            $table->string('certificaciones');
            $table->string('recomendacion1');
            $table->string('recomendacion2');
            $table->bigInteger('user_id');
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
        Schema::drop('documentacion');
    }
}
