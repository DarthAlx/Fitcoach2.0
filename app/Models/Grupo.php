<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 14/10/18
 * Time: 11:26 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model {

	use SoftDeletes;

	protected $table = 'grupos';

	protected $fillable = ['nombre','condominio_id','room_id','descripcion', 'user_id','clase_id','audiencia','cupo','tokens'];


	public function condominio(){
		return $this->belongsTo('App\Condominio');
	}
	public function horarios(){
		return $this->hasMany('App\Horario','grupo_id','id');
	}
	public function room(){
		return $this->belongsTo('App\Room');
	}
	public function coach(){
		return $this->hasOne('App\User','id','user_id');
	}
	public function clase(){
		return $this->belongsTo('App\Clase');
	}
}