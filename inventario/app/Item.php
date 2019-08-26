<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   //table properties
   protected $table='items';
   protected $fillable=['nombre','cantidad','equivale','precio_venta','categoria_id','unidad_id','empresa_id']; 
   //relations
   public function unidad(){
       return $this->belongsTo('App\Unidad');
   }
   public function categoria(){
       return $this->belongsTo('App\Categoria');
   }
   public function empresa(){
       return $this->belongsTo('App\Empresa');
   }
}