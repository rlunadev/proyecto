<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Financiero extends Model
{
	protected $table="estado_financieros";
	protected $fillable=['descripcion'];
	
    public function alumno(){
    	return $this->hasMany('App\Alumno','id_estado_financiero');
    }
}
