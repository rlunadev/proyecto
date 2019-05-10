<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table="empresas";
    protected $fillable=['nombre','direccion','email','telefono'];

    public function grupo() {
    	return $this->hasMany('App\Grupo');
    }
}
