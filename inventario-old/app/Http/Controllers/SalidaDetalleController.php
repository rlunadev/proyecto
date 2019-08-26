<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\SalidaDetalle;
use App\Item;
use DB;
class SalidaDetalleController extends Controller
{
    public function SaveData (Request $request) {
        // GET ITEM
        $item=Item::where('id','=',$request->item_id)->get();
        $data=new SalidaDetalle($request->all());
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //$data=Salida::where('empresa_id','=',$id_empresa)->get();
        DB::statement('call salidaItem(?,?,?,?)',[$data->item_id,$data->cantidad,0,$id_empresa]);
        $data=new SalidaDetalle($request->all());
        $data->nombre_producto=$item[0]->nombre;
        $data->precio_venta=$item[0]->precio_venta;
        $data->subTotal=$item[0]->precio_venta * $request->cantidad;
		//$data->save();
		$data->each(function($data){
			$data->empresa;
		});
        return response()->json(['result'=>$data]);
    }
    public function salidaItemCalculo (Request $request) {
        // GET ITEM
        $item=Item::where('id','=',$request->item_id)->get();
        $data=new SalidaDetalle($request->all());
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $nombre_empresa=JWTAuth::getPayload($request->token)->get('empresa.nombre');
        //$data=Salida::where('empresa_id','=',$id_empresa)->get();
        DB::statement('call salidaItemCalculo(?,?,?,?,?,?,?,?)',[$data->item_id,$data->cantidad,1,$id_empresa,$data->nombreSalida,$data->fecha,$data->total,$nombre_empresa]);
        
        return response()->json(['result'=>$data]);
    }
    public function index() {
        return view('salida.index');
    }
    public function listaSalida() {
        return view('salida.lista');
    }
    public function GetAll(){
        $data=SalidaDetalle::where('status','=','0')->get();
		//$data=SalidaDetalle::all();
		$data->each(function($data){
			$data->item;
			$data->salida;
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
	}
	//GET BY EMPRESA
	public function GetByEmpresaId(Request $request){
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data=SalidaDetalle::where('empresa_id','=',$id_empresa)->where('status','=','0')->get();
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
        $data=SalidaDetalle::find($request->id);
        if($data!=null){
            $item=Item::find($data->item_id);
            $item->cantidad=$item->cantidad+$data->cantidad;
            $item->save();
            $data->delete();
            return response()->json(['success'=>true,'item_id'=>$item->id]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=SalidaDetalle::where('id','=',$request->id)->get();
		$data->each(function($data){
			$data->categoria;
			$data->unidad;
			$data->empresa;
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = SalidaDetalle::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=SalidaDetalle::find($request->id);
            $data->nombre=$request->nombre;
            $data->total=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
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
