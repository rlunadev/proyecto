<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso_detalle extends Model
{
    protected $table = "Acceso_detalles";
    protected $fillable = [
        'user_id', 'sistema_id', 'descripcion','type'
    ];

    public function user(){
		return $this->belongsTo('App\User','user_id');
	}
    public function sistema(){
		return $this->belongsTo('App\Sistema','sistema_id');
	}
}
