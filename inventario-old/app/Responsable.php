<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
	Protected $table ="responsables";
    Protected $fillable=['nombres'];
    
    public function alumno(){
    	return $this->hasMany('App\Alumno','id_responsable');
    }
}
