<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    //table properties
    protected $table='compra_detalles';
    protected $fillable=['cantidad','precio_compra','precio_venta','descripcion','descripcion'];
    
    public function item(){
      return $this->belongsTo('App\Item','item_id');
    }

    public function compra(){
      return $this->belongsTo('App\Compra','compra_id');
    }
}
