<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

	protected $fillable = ['fecha', 'hora', 'user_id', 'recurrencia','zona_id','clase_id', 'grupo_id','room_id','tipo', 'audiencia', 'cupo', 'ocupados','tokens'];

  	public function clase(){
       	return $this->belongsTo('App\Clase');
    }
	public function grupo(){
		return $this->belongsTo('App\Grupo');
	}
	public function libres(){
		return $this->hasMany('App\Libres');
	}
	public function reservaciones(){
		return $this->hasMany('App\Reservacion');
	}
	public function user(){
       	return $this->belongsTo('App\User');
    }
    public function zona(){
    return $this->belongsTo('App\Zona');
	  }
	  public function room(){
		return $this->belongsTo('App\Room');
		  }
	  
}
