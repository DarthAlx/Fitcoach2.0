<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = ['nombre', 'descripcion', 'imagen'];

    public function grupos()
    {
        return $this->hasMany('App\Grupo');
    }

}
