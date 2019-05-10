<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //table properties
    protected $table='compras';
    protected $fillable=['nombre','total','fecha'];
    
    //search
    public function scopeSearch($query,$nombre) {
		return $query->where('nombre','LIKE',"%$nombre%");
	}
}
