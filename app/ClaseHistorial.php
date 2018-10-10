<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaseHistorial extends Model {

	protected $table = 'clase_historiales';
	protected $fillable = [ 'tipo', 'item_id', 'evento' ];
}
