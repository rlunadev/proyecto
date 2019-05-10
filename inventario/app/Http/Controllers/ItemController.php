<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Item;
use DB;
class ItemController extends Controller
{
    public function SaveData (Request $request) {
        $data=new Item($request->all());

        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data->empresa_id=$id_empresa;//Item::where('empresa_id','=',$id_empresa)->get();

		$data->save();
		$data->each(function($data){
			$data->categoria;
			$data->unidad;
			$data->empresa;
		});
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('item.index');
    }

    public function GetAll(Request $request){
        $data=Item::all();
       
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
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        //dd($request->token);
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
       // $data=Item::where('empresa_id','=',$id_empresa)->get();
        $data=Item::all();
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
        $data=Item::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=Item::where('id','=',$request->id)->get();
		$data->each(function($data){
			$data->categoria;
			$data->unidad;
			$data->empresa;
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Item::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Item::find($request->id);
            $data->nombre=$request->nombre;
            $data->cantidad=$request->cantidad;
            $data->equivale=$request->equivale;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
            $data->save();
           // GET DATA
           $data=Item::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
