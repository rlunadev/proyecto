<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table="categorias";
    protected $fillable=['nombre','descripcion'];
    
    // public function scopeSearch($query,$nombre) {
	// 	return $query->where('nombre','LIKE',"%$nombre%");
	// }
	// public function scopeSearchCategoria($query,$nombre) {
	// 	return $query->where('nombre','=',$nombre);
	// }
	public function formulaDetalle() {
    	return $this->hasMany('App\FormulaDetalle');
    }
}
