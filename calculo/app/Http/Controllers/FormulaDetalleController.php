<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\FormulaDetalle;
use App\Parametro;
use DB;
class FormulaDetalleController extends Controller
{
    public function SaveData (Request $request) {
        // GET ITEM
        //$item=Parametro::where('id','=',$request->item_id)->get();
        //$data=new SalidaDetalle($request->all());
        
        //$id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        //$data=Salida::where('empresa_id','=',$id_empresa)->get();
        //DB::statement('call salidaItem(?,?,?,?)',[$data->item_id,$data->cantidad,0,$id_empresa]);
       // dd($data);

        $data=new FormulaDetalle($request->all());
        $data->parametro_id=$request->parametro_id;
        $data->precio=$request->precio/$request->equivale;
        $data->cantidad=$request->cantidad;
       // $data->categoria_id=$request->categoria_id;
       // dd($request->categoria_id);
        $data->subTotal=$data->precio * $request->cantidad;
		$data->save();
		// $data->each(function($data){
		// 	$data->empresa;
		// });
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('formulaDetalle.index');
    }
    public function listaSalida() {
        return view('salida.lista');
    }
    public function GetAll(){
        $data=formulaDetalle::whereNull('formula_id')->get();
        //$data=FormulaDetalle::all()->whereNull('formula_id');
        $data->each(function($data){
			$data->parametro;
			$data->categoria;
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
        $data=FormulaDetalle::find($request->id);
        if($data!=null){
            
            $data->delete();
            return response()->json(['success'=>true,'item_id'=>$data->id]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=FormulaDetalle::where('id','=',$request->id)->get();
		
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = FormulaDetalle::All();
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
