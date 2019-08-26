<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    Protected $table ="calificaciones";
    Protected $fillable=['id_alumnos','fecha_inicio','fecha_final','total_horas','tarea_asignada','calificacion','nota_total','literal','literal','fecha'];

    public function Alumno() {
    	return $this->belongsTo('App\Alumno','id_alumnos');
    }
}
