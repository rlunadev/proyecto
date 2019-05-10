<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoriaRequest;
use App\Unidad;
class UnidadController extends Controller
{
    public function SaveData (Request $request) {
        $data=new Unidad($request->all());
        $data->save();
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('unidad.index');
    }

    public function GetAll(){
        $data=Unidad::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Unidad::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Unidad::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Unidad::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $data=Unidad::find($request->id);
            $data->nombre=$request->nombre;
			$data->descripcion=$request->descripcion;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
