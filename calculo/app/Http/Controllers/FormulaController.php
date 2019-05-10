<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Formula;
use App\FormulaDetalle;
use Validator;
//use App\Item;
use DB;
class FormulaController extends Controller
{
    public function SaveData (Request $request) {
        
        $rules = [
            'nombre' => 'required|unique:formulas',
            'fecha' => 'required'
        ];
        $input = $request->only('nombre', 'fecha');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        //$id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');

        $data=new Formula($request->all());
        $data->save();
        //update formula detalle
        DB::table('formulas_detalles')
        ->where('formula_id',null)
        ->update(['formula_id'=>$data->id]);
        $formula_detalle=formulaDetalle::whereNull('formula_id')->get();
        $formula_detalle->each(function($formula_detalledata){
			$formula_detalle->formula_id=$data->id;
        });
        
       // $item=Parametro::where('id','=',$request->item_id)->update();
        //DB::statement('call cerrarSalida(?,?,?)',[$data->nombre,$data->empresa_solicitante,$id_empresa]);
        return response()->json(['success'=>true,'data'=>$data]);
    }

    public function index() {
        return view('formula.index');
    }

    public function GetAll(Request $request){
        // $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        // $data=Salida::where('empresa_id','=',$id_empresa)->get();
		$data=Formula::all();
		$data->each(function($data){
			$data->formulaDetalle;
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
        $data=Formula::where('empresa_id','=',$id_empresa)->get();
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
        $data=Formula::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }
	//GET BY ID
    public function GetById(Request $request){
		$data=Formula::where('id','=',$request->id)->get();
		$data->each(function($data){
            $data->formulaDetalle;
            $form=$data->formulaDetalle;
            $form->each(function($form){
                $form->parametro;
            });
        });
        
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Formula::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=Formula::find($request->id);
            $data->nombre=$request->nombre;
            $data->total=$request->cantidad;
            $data->precio_unitario=$request->precio_unitario;
			$data->precio_venta=$request->precio_venta;
			//$data->descripcion=$request->descripcion;
			$data->categoria_id=$request->categoria_id;
			$data->unidad_id=$request->unidad_id;
            $data->save();
           // GET DATA
           $data=Formula::where('id','=',$request->id)->get();
           $data->each(function($data){
               $data->categoria;
               $data->unidad;
               $data->empresa;
           });
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
