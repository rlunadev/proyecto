<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
   //table properties
   protected $table='pagos';
   protected $fillable=['nombre','fecha']; 
   //relations
   public function pagoDetalle(){
       return $this->hasMany('App\PagoDetalle');
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