<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Configuracion;

class InicioController extends Controller
{
    public function RedirectToServer(){
        dd('wer');
        $data=Configuracion::all()->take(1);        
        return response()->json($data);
    }
    public function index(Request $request){
        return View('home.index');
    }

    public function setMenu(Request $request){
        dd('wer');
        $nombre=JWTAuth::getPayload($request->token)->get('nombre');
        $data=JWTAuth::getPayload($request->token)->get('0');
        $array =  (array) $data;
        $resultado=$this->search($array,'sistema', 'stock');
        return response()->json([
            'success'=>true,
            'user'=>$nombre,
            'data'=>$resultado
        ]);
        return (response()->json($data));
    }

    public function search($array,$key, $value)
    {
        dd('wer');
        $return = array();   
        foreach ($array as $k=>$subarray){  
          if (isset($subarray[$key]) && $subarray[$key] == $value) {
            $return[$k] = $subarray;
            return $return;
          } 
        }
    }
}
