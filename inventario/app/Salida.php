<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table="salidas";

    protected $fillable = [
        'nombre', 'total','fecha','empresa_id','empresa_solicitante'
    ];

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function salidaDetalle() {
    	return $this->hasMany('App\SalidaDetalle');
    }
}
