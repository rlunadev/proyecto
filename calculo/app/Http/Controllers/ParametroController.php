<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Parametro;
use DB;
class ParametroController extends Controller
{
    public function SaveData (Request $request) {
        // GET ITEM
        //$item=Parametro::where('id','=',$request->item_id)->get();
        
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //DB::statement('call salidaItem(?,?,?,?)',[$data->item_id,$data->cantidad,0,$id_empresa]);
        $data=new Parametro($request->all());
        $data->nombre=$data->nombre;
        $data->precio_venta=$data->precio_venta;
        $data->unidad_id=$data->unidad_id;
        $data->unidad_formula=$data->unidad_formula;
        $data->empresa_id=$data->empresa_id;
        $data->nombre_empresa=$data->nombre_empresa;
        
        $data->item_id=$data->item_id;
        $item=Parametro::where('item_id','=',$data->item_id)->get();
        //$item=Parametro::find($request->item_id);
        if(!$item->count()){
            $data->save();
        }
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('parametro.index');
    }
    public function listaSalida() {
        return view('salida.lista');
    }
    public function GetAll(){
       // $data=Parametro::where('status','=','0')->get();
		$data=Parametro::all();
		// $data->each(function($data){
		// 	$data->item;
		// 	$data->salida;
		// });
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        $data=Parametro::all();
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //$data=Parametro::where('empresa_id','=',$id_empresa)->where('status','=','0')->get();
		$data->each(function($data){
			$data->unidad;
			$data->empresa;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}

    public function DeleteById(Request $request){
        $data=Parametro::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true,'item_id'=>$data]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=Parametro::where('id','=',$request->id)->get();
		
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Parametro::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Parametro::find($request->id);
            $data->nombre=$request->nombre;
            $data->total=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
            $data->unidad_id=$request->unidad_id;
            $data->unidad=$request->unidad;
            $data->categoria=$request->categoria;
            $data->save();
           // GET DATA
           $data=SalidaDetalle::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
