<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
   //table properties
   protected $table='proyectos';
   protected $fillable=['nombre','ubicacion','total','presupuesto','fecha_inicio,','fecha_final','status']; 
   //relations
   public function modulo(){
       return $this->hasMany('App\Modulo');
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