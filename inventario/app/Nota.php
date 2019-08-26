<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	Protected $table ="notas";
    Protected $fillable=['id_alumno','id_docente','practica_diaria','practica_grupal','recital','asistencia','examen_final'];

    public function alumno() {
    	return $this->hasMany('App\Alumno');
    }
}
