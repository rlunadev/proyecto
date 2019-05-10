<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Http\Requests;
use App\Http\Requests\ProveedorRequest;

class ProveedorController extends Controller
{
    public function SaveData (Request $request) {

        
        $data=new Proveedor($request->all());
        $data->save();
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('proveedor.index');
    }

    public function GetAll(){
        $data=Proveedor::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Proveedor::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Proveedor::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Proveedor::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $data=Proveedor::find($request->id);
            $data->nombre=$request->nombre;
            $data->vendedor=$request->vendedor;
            $data->telefono=$request->telefono;
            $data->direccion=$request->direccion;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
