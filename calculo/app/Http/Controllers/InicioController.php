<?php                           
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Configuracion;
use DB;

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
    public function avanzeProyecto (Request $request) {
        $sqlQuery = " SELECT p.total, p.presupuesto, p.id, p.nombre,p.fecha_inicio,p.fecha_final,p.status, COUNT(m.id) totalModulos, (SELECT COUNT(m.status) FROM modulos m WHERE m.status = 1 AND m.proyecto_id = p.id) totalActivos, IFNULL(ROUND(((SELECT COUNT(m.status) FROM modulos m WHERE m.status = 1 AND m.proyecto_id = p.id)*100)/COUNT(m.id) ,2),0) porcentaje FROM proyectos p left JOIN modulos m ON p.id=m.proyecto_id GROUP BY p.id; ";
        $data = DB::select(DB::raw($sqlQuery));
        
        return response()->json(['result'=>$data]);
    }
}
