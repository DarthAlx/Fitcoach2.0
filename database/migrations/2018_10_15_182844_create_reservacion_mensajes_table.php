<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionMensajesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'mensajes', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->text( 'mensaje' );
			$table->integer( 'user_id' );
			$table->integer( 'reservacion_id' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'mensajes' );
	}
}
