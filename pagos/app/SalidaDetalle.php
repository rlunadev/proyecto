<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalidaDetalle extends Model
{
    protected $table="salida_detalles";
    
    protected $fillable = [
        'cantidad', 'precio_venta','descripcion','item_id','salida_id','nombre_producto','status'
    ];

    public function salida() {
    	return $this->belongsTo('App\Salida');
    }

    public function item() {
    	return $this->belongsTo('App\Item');
    }
}
