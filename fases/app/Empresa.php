<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table="empresas";
    protected $fillable=['nombre','direccion','email','telefono'];

    public function item() {
    	return $this->hasMany('App\Item');
    }
    public function salida() {
    	return $this->hasMany('App\Salida');
    }

}
