<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso_Docente extends Model
{
	Protected $table ="curso_docentes";
    Protected $fillable=['id_curso','id_docente'];

    public function curso(){
    	return $this->belongsTo('App\Curso','id_curso');
    }
    public function docente(){
    	return $this->belongsTo('App\Docente','id_docente');
    }
}
