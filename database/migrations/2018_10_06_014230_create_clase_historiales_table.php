<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaseHistorialesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'clase_historiales', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'tipo' );
			$table->string( 'item_id' );
			$table->enum( 'evento', [ 'inicio', 'fin' ] );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'clase_historiales' );
	}
}
