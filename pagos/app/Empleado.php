<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   //table properties
   protected $table='empleados';
   protected $fillable=['nombre','edad','tipoPago_id','tipoEmpleado_id','status','monto']; 
   //relations
   public function tipoEmpleado(){
       return $this->belongsTo('App\TipoEmpleado');
   }
   public function tipoPago(){
       return $this->belongsTo('App\TipoPago');
   }
//    public function empresa(){
//        return $this->belongsTo('App\Empresa');
//    }
}