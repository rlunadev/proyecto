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
class ModuloDetalleController extends Controller
{
    public function SaveData (Request $request) {
        $data=new ModuloDetalle($request->all());
        $data->formula_id=$request->formula_id;
        $data->subTotal=$request->subTotal;
        $data->save();
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('modulo.index');
    }

    public function GetAll(Request $request){
        $data=ModuloDetalle::whereNull('modulo_id')->get();
		$data->each(function($data){
			$data->formula;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data=Modulo::where('empresa_id','=',$id_empresa)->get();
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
        $data=ModuloDetalle::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=ModuloDetalle::where('id','=',$request->id)->get();
		$data->each(function($data){
			$data->salidaDetalle;
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Modulo::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Modulo::find($request->id);
            $data->nombre=$request->nombre;
            $data->total=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
            $data->save();
           // GET DATA
           $data=Modulo::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
