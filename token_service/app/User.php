<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table="users";

    protected $fillable = [
        'name', 'email','password','grupo_id','is_verified'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sistemaRegistro(){
        return $this->belongsTo('App\SistemaRegistrado');
    }
    public function grupo(){
        return $this->belongsTo('App\Grupo');
    }
    public function admin() {
        return $this->type==='admin';
    }
}
