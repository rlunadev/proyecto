<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $table="sistemas";
    
    protected $fillable = [
        'nombre', 'ruta', 'token'
    ];
}
