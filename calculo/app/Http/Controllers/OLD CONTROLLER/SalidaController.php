<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Salida;
use App\SalidaDetalle;
use Validator;
//use App\Item;
use DB;
class SalidaController extends Controller
{
    public function SaveData (Request $request) {
        //dd($request);
        $rules = [
            'nombre' => 'required',
            'empresa_solicitante' => 'required'
        ];
        $input = $request->only('nombre', 'empresa_solicitante');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data=new Salida($request->all());
        DB::statement('call cerrarSalida(?,?,?)',[$data->nombre,$data->empresa_solicitante,$id_empresa]);
        return response()->json(['success'=>true]);
    }

    public function index() {
        return view('salida.index');
    }

    public function GetAll(Request $request){
        // $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        // $data=Salida::where('empresa_id','=',$id_empresa)->get();
		$data=Salida::all();
		$data->each(function($data){
			$data->salidaDetalle;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        //dd($request->token);
        //$data=Item::where('empresa_id','=','2')->get();
        //$data=Salida::all();
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
}
