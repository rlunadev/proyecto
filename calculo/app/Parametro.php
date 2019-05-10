<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
   //table properties
   protected $table='parametros';
   protected $fillable=['nombre','precio_venta','unidad_formula','empresa_id','nombre_empresa','unidad_id','item_id','equivale','unidad','categoria']; 
   //relations
//    public function unidad(){
//        return $this->belongsTo('App\Unidad');
//    }
//    public function formula() {
// 	 return $this->belongsTo('App\Formula');
//    }
//    public function categoria(){
//        return $this->belongsTo('App\Categoria');
//    }
//    public function empresa(){
//        return $this->belongsTo('App\Empresa');
//    }
}