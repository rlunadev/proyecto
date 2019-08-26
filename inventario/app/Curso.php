<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

	protected $table="cursos";
	protected $fillable=['id_ciclo','descripcion','aula'];

    public function curso_docente(){
    	return $this->hasMany('App\Curso_Docente');
    }
    public function ciclo(){
    	return $this->belongsTo('App\Ciclo','id_ciclo');
    }
}
