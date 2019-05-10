<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
   //table properties
   protected $table='formulas';
   protected $fillable=['nombre','fecha','subTotal']; 
   //relations
   public function unidad(){
       return $this->belongsTo('App\Unidad');
   }
   public function formulaDetalle() {
	 return $this->hasMany('App\FormulaDetalle');
   }
   public function modulo() {
	return $this->hasMany('App\Modulo');
  }
//    public function categoria(){
//        return $this->belongsTo('App\Categoria');
//    }
//    public function empresa(){
//        return $this->belongsTo('App\Empresa');
//    }
}