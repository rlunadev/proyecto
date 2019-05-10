<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categoria;
use Validator;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
	public function SaveData (Request $request) {
        $rules = [
            'nombre' => 'required|unique:categorias',
            'descripcion' => 'required'
        ];
        $input = $request->only('nombre', 'descripcion');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }


        $data=new Categoria($request->all());
        $data->save();
        return response()->json(['success'=> true,'result'=>$data]);
    }

    public function index() {
        return view('categoria.index');
    }

    

    public function GetAll(){
        $data=Categoria::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Categoria::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Categoria::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Categoria::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $rules = [
            'nombre' => 'required|unique:categorias',
            'descripcion' => 'required'
        ];
        $input = $request->only('nombre', 'descripcion');
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $data=Categoria::find($request->id);
            $data->nombre=$request->nombre;
			$data->descripcion=$request->descripcion;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
