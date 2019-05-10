<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
   //table properties
   protected $table='modulos';
   protected $fillable=['nombre','fecha_inicio','fecha_final']; 
   //relations
   public function proyecto(){
       return $this->belongsTo('App\Proyecto');
   }
   public function formula() {
	 return $this->belongsTo('App\Formula');
   }
   public function moduloDetalle() {
    return $this->belongsTo('App\ModuloDetalle');
  }
}