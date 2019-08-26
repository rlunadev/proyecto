<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //table properties
    protected $table='productos';
    protected $fillable=['nombre','cantidad','precio','codigo','stockMinimo','unidadId','categoriaId','proveedorId','almacenId'];
    //relations
    public function unidad(){
		return $this->belongsTo('App\Unidad','unidadId');
    }
    public function categoria(){
		return $this->belongsTo('App\Categoria','categoriaId');
    }
    public function proveedor(){
		return $this->belongsTo('App\Proveedor','proveedorId');
    }
    public function almacen(){
      return $this->belongsTo('App\Almacen','almacenId');
      }
    //search
    public function scopeSearch($query,$nombre) {
		return $query->where('nombre','LIKE',"%$nombre%");
	}
}
