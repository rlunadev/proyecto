<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rol;
use Validator;
use App\Http\Requests\CategoriaRequest;

class RolController extends Controller
{
	public function SaveData (Request $request) {
        $rules = [
            'nombre' => 'required|unique:roles'
        ];

        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $data=new Rol($request->all());
        $data->save();
        return response()->json(['success'=> true,'result'=>$data]);
    }

    public function index() {
        return view('roles.index');
    }

    public function GetAll(Request $request){
        $data=Rol::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Rol::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Rol::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Rol::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $rules = [
            'nombre' => 'required|unique:roles'
        ];
        $input = $request->only('nombre');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $data=Rol::find($request->id);
            $data->nombre=$request->nombre;
            $data->categoria_id=$request->categoria_id;
            $data->categoria_id=$request->categoria_id;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
