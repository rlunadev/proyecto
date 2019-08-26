<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Grupo extends Authenticatable
{
    use Notifiable;
    protected $table="grupos";
    protected $fillable = ['nombre'];
    public function rol(){
        return $this->belongsTo('App\Rol');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function usuario(){
        return $this->hasMany('App\Sistema');
    }
}
