<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sistema;

class SistemasController extends Controller
{

    public function SaveData (Request $request) {
        $data=new Sistema($request->all());
        $data->save();
        //dd($data);
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('sistemas.index');
    }

    public function GetAll(){
        $data=Sistema::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Sistema::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Sistema::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Sistema::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $data=Sistema::find($request->id);
            $data->nombre=$request->nombre;
            $data->ruta=$request->ruta;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
