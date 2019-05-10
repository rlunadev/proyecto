<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model {

	protected $table = "almacenes";
	protected $fillable=['nombre','empresaId','ubicacion','descripcion'];

	public function scopeSearch($query,$nombre) {
		return $query->where('nombre','LIKE',"%$nombre%");
	}
	public function empresa(){
		return $this->belongsTo('App\Empresa','empresaId');
	}
}
