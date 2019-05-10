<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    protected $table="tipo_empleados";
    protected $fillable=['nombre','descripcion'];
    
    // public function scopeSearch($query,$nombre) {
	// 	return $query->where('nombre','LIKE',"%$nombre%");
	// }
	// public function scopeSearchCategoria($query,$nombre) {
	// 	return $query->where('nombre','=',$nombre);
	// }
	public function empleado() {
    	return $this->hasMany('App\Empleado');
    }
}
