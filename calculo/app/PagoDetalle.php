<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
   //table properties
   protected $table='pago_detalles';
   protected $fillable=['nombre','salario']; 
   //relations
   public function pago(){
       return $this->belongsTo('App\Pago');
   }
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