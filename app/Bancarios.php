<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancarios extends Model
{
  protected $table = 'bancarios';
  protected $fillable = ['banco', 'cta', 'clabe', 'tarjeta', 'adicional', 'user_id'];
  public function user(){
      return $this->belongsTo('App\User');
  }

}
