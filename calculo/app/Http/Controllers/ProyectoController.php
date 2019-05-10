<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Proyecto;
use App\Formula;
use App\FormulaDetalle;
use App\Parametro;
use App\Modulo;
use App\ModuloDetalle;
use Validator;
//use App\Item;
use DB;
class ProyectoController extends Controller
{
    public function SaveData (Request $request) {
        //dd($request);
        $rules = [
            'nombre' => 'required'
        ];
        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        //dd();
        $data=new Proyecto();
        $data->nombre=$request->nombre;
        $data->ubicacion=$request->ubicacion;
        $data->presupuesto=$request->presupuesto;
        $data->fecha_inicio=$request->fecha_inicio;
        $data->fecha_final=$request->fecha_final;
        $data->total=$request->total;
        

        $data->save();
        //update formula detalle
        DB::table('modulos')
        ->where('proyecto_id',null)
        ->update(['proyecto_id'=>$data->id]);

        // $formula_detalle=formulaDetalle::whereNull('formula_id')->get();
        // $formula_detalle->each(function($formula_detalledata){
		// 	$formula_detalle->formula_id=$data->id;
        // });
        

        // if($validator->fails()) {
        //     $error = $validator->messages();
        //     return response()->json(['success'=> false, 'error'=> $error]);
        // }
        // $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        // $data=new Salida($request->all());
        // DB::statement('call cerrarSalida(?,?,?)',[$data->nombre,$data->empresa_solicitante,$id_empresa]);
        return response()->json(['success'=>true]);
    }

    public function index() {
        return view('proyecto.index');
    }
    public function lista() {
        return view('proyecto.lista');
    }
    public function GetAll(Request $request){
        // $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        // $data=Salida::where('empresa_id','=',$id_empresa)->get();
		$data=Proyecto::all();
		// $data->each(function($data){
		// 	$data->salidaDetalle;
		// });
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
		$data=Proyecto::where('id','=',$request->id)->get();
		$data->each(function($data){
            $moduloDet=$data->modulo;
            $moduloDet->each(function($moduloDet){
                $moduloDet->moduloDetalle=moduloDetalle::where('modulo_id','=',$moduloDet->id)->get();
                $formulaDetalle=$moduloDet->moduloDetalle;
                $formulaDetalle->each(function($formulaDetalle){
                    $formulaDet=$formulaDetalle->formula;
                    $formulaDetalle=formulaDetalle::where('formula_id','=',$formulaDet->id)->get();
                });
            });
        });
       
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function GetByIdDate(Request $request){
        $data=Proyecto::where('id','=',$request->id)->get();
       
		$data->each(function($data){
            $data->modulo;
        });
        $mode = $data[0]->modulo;
        $mod = (array) null;
        foreach($mode as $d){
            $c = ['id'=>$d->id, 'name'=>$d->nombre,'start'=>$d->fecha_inicio,'end'=>$d->fecha_final];
            array_push($mod,$c);
            //array_push()
        }
        $datas = (array) null;
        $custom = ['id'=>$data[0]->id, 'name'=>$data[0]->nombre,'series'=>$mod];

        array_push($datas,$custom);
        return response()->json($datas);
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
