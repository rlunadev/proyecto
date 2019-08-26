<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SistemaRegistrado extends Model
{
    protected $table="sistema_registros";
    
    protected $fillable = [
        'nombre','sistema_id'
    ];
    public function sistema(){
        return $this->belongsTo('App\Sistema');
    }
    public function user() {
    	return $this->hasMany('App\User');
    }
}
