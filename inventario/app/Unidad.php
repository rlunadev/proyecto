<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
   protected $table="unidades";
   protected $fillable=['nombre','valor','descripcion'];

     public function scopeSearch($query,$nombre) {
        return $query->where('nombre','LIKE',"%$nombre%");
    }
    public function item() {
    	return $this->hasMany('App\Item');
    }
}