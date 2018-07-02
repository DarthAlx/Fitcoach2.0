<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libres extends Model
{
    protected $table = 'libres';

	protected $fillable = ['fecha', 'user_id'];

  	public function user(){
       	return $this->belongsTo('App\User');
    }
}
