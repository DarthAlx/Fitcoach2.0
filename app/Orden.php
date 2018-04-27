<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
  	protected $table = 'ordenes';
  	protected $fillable = ['order_id', 'user_id','paquetecomprado_id','folio', 'cantidad', 'impuestos', 'descuento', 'metadata', 'status', 'comentarios'];
  	public function user()
	 {
	   return $this->belongsTo('App\User');
	 }

	 public function paquete()
	 {
	   return $this->belongsTo('App\PaqueteComprado');
	 }

	 
}
