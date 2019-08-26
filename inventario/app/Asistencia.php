<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
	Protected $table ="asistencias";
    Protected $fillable=['id_alumno','id_curso_docente','estado'];

    public function alumno(){
    	return $this->belongsTo('App\Alumno','id_alumno');
    }
    public function curso_docente(){
    	return $this->belongsTo('App\Curso_Docente','id_curso_docente');
    }
    
}
