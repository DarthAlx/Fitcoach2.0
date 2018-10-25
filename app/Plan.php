<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';

	protected $fillable = ['inicio', 'medular','final','minutosinicio','minutosmedular','minutosfinal','comentarios','objetivos','materiales','reservacion_id','tipo','item_id'];

  	public function reservacion(){
       	return $this->belongsTo('App\Reservacion');
    }
}
