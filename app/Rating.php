<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  protected $table = 'ratings';
  protected $fillable = ['rate', 'orden_id','user_id'];
  public function user(){
    return $this->belongsTo('App\User');
  }
  public function orden(){
    return $this->belongsTo('App\Orden');
  }
}
