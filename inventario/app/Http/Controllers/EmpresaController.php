<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Empresa;
class EmpresaController extends Controller
{
	public function SaveData (Request $request) {
        $data=new Empresa($request->all());
        $data->save();
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('empresa.index');
    }

    public function GetAll(){
        $data=Empresa::all();//->take(10);
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=Empresa::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=Empresa::find($request->id);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = Empresa::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
        $data=Empresa::find($request->id);
            $data->nombre=$request->nombre;
			$data->direccion=$request->direccion;
			$data->email=$request->email;
			$data->telefono=$request->telefono;
            $data->save();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}