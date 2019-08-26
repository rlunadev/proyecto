<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Configuracion;

class InicioController extends Controller
{
    public function RedirectToServer(){
        $data=Configuracion::all()->take(1);        
        return response()->json($data);
    }

    public function index(Request $request){
        return View('home.index');
    }

    // 
    public function setMenu(Request $request){
        $data=JWTAuth::getPayload($request->token);
        $permisos = $data->get('permiso')['grupos'];
        $resultado=array();
        foreach ($permisos as $permiso) { 
            if( $permiso['nombre']== 'calculo' ) {
                $resultado = $permiso['nombre'];
            }
        }

        return response()->json([
            'success'=>true,
            'user'=>$data->get('usuario'),
            'rol'=>$data->get('rol'),
            'data'=>$resultado
        ]);

        return (response()->json($data));
    }

    public function search($array,$key, $value)
    {
        $return = array();   
        foreach ($array as $k=>$subarray){  
          if (isset($subarray[$key]) && $subarray[$key] == $value) {
            $return[$k] = $subarray;
            return $return;
          } 
        }
    }
}
