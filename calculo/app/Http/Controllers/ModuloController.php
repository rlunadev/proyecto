<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Modulo;
use App\ModuloDetalle;
use Validator;
//use App\Item;
use DB;
class ModuloController extends Controller
{
    public function SaveData (Request $request) {
        //dd($request);
        $rules = [
            'nombre' => 'required'
        ];
        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        
        $data=new Modulo($request->all());
        $data->save();
        //update formula detalle
        DB::table('modulos_detalles')
        ->where('modulo_id',null)
        ->update(['modulo_id'=>$data->id]);
        $modulo_detalle=ModuloDetalle::whereNull('modulo_id')->get();
        $modulo_detalle->each(function($modulo_detalle){
			$modulo_detalle->modulo_id=$data->id;
        });
        return response()->json(['success'=>true,'data'=>$data]);
    }

    public function index() {
        return view('modulo.index');
    }
    public function lista() {
        return view('modulo.lista');
    }
    public function GetAll(Request $request){
        
        $data=Modulo
        ::join('modulos_detalles','modulos.id','=','modulos_detalles.modulo_id')
        ->select('*')
        //->whereNull('proyecto_id')
        ->groupBy('nombre')
        ->getQuery()
        ->get();
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data=Salida::where('empresa_id','=',$id_empresa)->get();
		$data->each(function($data){
			$data->categoria;
			$data->unidad;
			$data->empresa;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}

    public function DeleteById(Request $request){
        $data=Salida::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=Salida::where('id','=',$request->id)->get();
		$data->each(function($data){
			$data->salidaDetalle;
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Salida::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Salida::find($request->id);
            $data->nombre=$request->nombre;
            $data->total=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
            $data->save();
           // GET DATA
           $data=Salida::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
    //update date for subsystem fases
    public function UpdateDataById(Request $request){
        $data=Modulo::find($request->id);
        $data->fecha_inicio=$request->fecha_inicio;
        $data->fecha_final=$request->fecha_final;
        $data->save();
        return response()->json(['success'=>true]);
    }
}
