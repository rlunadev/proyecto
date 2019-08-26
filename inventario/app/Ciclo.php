<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
	protected $table="ciclos";
	protected $fillable=['descripcion','precio'];
	
    public function cursos() {
    	return $this->hasMany('App\Curso','id_ciclo');
    }

    public function scopeSearchCiclo ($query,$name) {
    	return $query->where('descripcion','=',$name);
    }
}
