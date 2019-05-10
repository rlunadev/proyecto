<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormulaDetalle extends Model
{
   //table properties
   protected $table='formulas_detalles';
   protected $fillable=['cantidad','precio','subTotal','categoria_id']; 
   //relations
   public function pago(){
       return $this->belongsTo('App\Pago');
   }
   public function formula(){
       return $this->belongsTo('App\Formula');
   }
   public function parametro(){
       return $this->belongsTo('App\Parametro');
   }
   public function categoria(){
    return $this->belongsTo('App\Categoria');
    }
}