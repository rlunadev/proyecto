<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Configuracion;

class InicioController extends Controller
{
    public function RedirectToServer(){
        $data=Configuracion::all()->take(1);        
        return response()->json($data);
    }
}
