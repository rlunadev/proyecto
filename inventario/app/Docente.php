<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table="docentes";
	protected $fillable=['nombres','apellidos','telefono','email','domicilio'];

    public function curso_docente(){
    	return $this->hasMany('App\Curso_Docente');
    }
}
