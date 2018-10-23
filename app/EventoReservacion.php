<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoReservacion extends Model
{
    protected $table = 'evento_reservaciones';

	protected $fillable = ['evento_id', 'user_id', 'valor_pagado', 'estado'];

	public function usuario()
	{
		return $this->hasOne('App\User','id','user_id');
	}
}
