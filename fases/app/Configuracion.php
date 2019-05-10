<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table="configuracion";
    protected $fillable=['servidor_logueo','ruta_inicial'];
}
