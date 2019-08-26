<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    Protected $table ="alumnos";
    Protected $fillable=['id','practicante','empresa','carrera','semestre','coordinador','name','evaluacion_inicio','evaluacion_final','total_hrs','razon_social','direccion','telefono','nombre_tutor','cargo','area_asignada','tarea_asignada'];

    public function Calificacion() {
    	return $this->hasMany('App\Calificacion');
    }
}
