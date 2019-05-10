<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloDetalle extends Model
{
   //table properties
   protected $table='modulos_detalles';
   protected $fillable=['cantidad','subTotal','formula_id']; 
   //relations
   public function proyecto(){
       return $this->belongsTo('App\Proyecto');
   }
   public function formula() {
	 return $this->belongsTo('App\Formula');
   }
   public function modulo() {
    return $this->hasMany('App\Modulo');
  }
}