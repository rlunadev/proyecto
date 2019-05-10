<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Empresa;
use App\Rol;
use Validator;
use App\Http\Requests\CategoriaRequest;

class GrupoController extends Controller
{
	public function SaveData (Request $request) {
        $rules = [
            'nombre' => 'required|unique:grupos'
        ];
        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $data=new Grupo($request->all());
        $data->rol_id=$request->rol_id;
        $data->grupo_id=$request->grupo_id;
        $data->save();
        return response()->json(['success'=> true,'result'=>$data]);
    }

    public function index() {
        return view('grupos.index');
    }

    public function GetAll(Request $request){
        $data=Grupo::all();//->take(10);
        $data->each(function($data){
            $data->rol;
            $data->empresa;			
		});
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Grupo::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Grupo::where('id','=',$request->id)->get();
        $data->each(function($data){
            $data->rol;
            $data->empresa;			
		});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Grupo::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $rules = [
            'nombre' => 'required'
        ];
        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $data=Grupo::find($request->id);
            $data->nombre=$request->nombre;
            $data->rol_id=$request->rol_id;
            $data->empresa_id=$request->empresa_id;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
    public function GetSelect(Request $request){
        $data=Grupo::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

}
