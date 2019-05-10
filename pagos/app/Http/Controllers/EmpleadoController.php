<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Empleado;
use App\TipoPago;
use App\TipoEmpleado;
use DB;
class EmpleadoController extends Controller
{
    public function SaveData (Request $request) {
        $data=new Empleado($request->all());

        //$id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //$data->empresa_id=$id_empresa;//Item::where('empresa_id','=',$id_empresa)->get();

		$data->save();
		$data->each(function($data){
			$data->tipoEmpleado;
			$data->tipoPago;
		});
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('empleado.index');
    }

    public function GetAll(Request $request){
        $data=Empleado::all();
       
		$data->each(function($data){
			$data->tipoEmpleado;
			$data->tipoPago;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        //dd($request->token);
       // $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //$data=Empleado::where('empresa_id','=',$id_empresa)->get();
        $data=Empleado::all();
		$data->each(function($data){
			$data->tipoEmpleado;
			$data->tipoPago;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}

    public function DeleteById(Request $request){
        $data=Empleado::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=Empleado::where('id','=',$request->id)->get();
		$data->each(function($data){
			$data->tipoEmpleado;
			$data->tipoPago;
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Empleado::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Empleado::find($request->id);
            $data->nombre=$request->nombre;
            $data->cantidad=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
            $data->save();
           // GET DATA
           $data=Empleado::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
