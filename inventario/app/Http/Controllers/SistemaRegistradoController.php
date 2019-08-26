<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\SistemaRegistrado;

class SistemaRegistradoController extends Controller
{
    public function SaveData (Request $request) {
        $data=new SistemaRegistrado($request->all());
        $ids=implode(',',$request->input('sistema_id'));
        $data->sistema_id=$ids;
        $data->save();
        // $data->each(function($data){
        //     $data->sistema;
        // });
        return response()->json(['result'=>$data]);
    }

    public function index() {
        return view('sistemaRegistrado.index');
    }

    public function GetAll(){

        $data=SistemaRegistrado::all();//->take(10);
        // $data->each(function($data){
		// 	$data->sistema;
		// });
        return response()->json([
            'success'=>true,
            'data'=> [ 'data' => $data]
        ]);
    }

    public function DeleteById(Request $request){
        $data=SistemaRegistrado::find($request->id);
        if($data!=null){
            $data->delete();
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>'Error']);
    }

    public function GetById(Request $request){
        $data=SistemaRegistrado::find($request->id);
       // $data->each(function($data){
		//	$data->sistema;
		//});
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }

    public function DeleteAll() {
       $data = SistemaRegistrado::All();
       return response()->json(['success'=>true]);
     }

    public function Update(Request $request) {
            $data=SistemaRegistrado::find($request->id);
            $data->nombre=$request->nombre;
            //$data->sistema_id=$request->sistema_id;
            $ids=implode(',',$request->input('sistema_id'));
            $data->sistema_id=$ids;
            $data->save();
            return response()->json(['success'=>true,'data'=>$data]);
            // $data->save();
            // $data=SistemaRegistrado::where('id','=',$request->id)->get();
            // $data->each(function($data){
            //     $data->sistema;
            // });
        return response()->json(['success'=>true,'data'=>$data]);
    }
    public function GetByTokenId(Request $request){
        $id_empresa=JWTAuth::getPayload($request->token)->get('empresa.id');
        $data=SistemaRegistrado::find($id_empresa);
        //$data=SistemaRegistrado::where('id','=',$id_empresa);
        //dd($data);
        return response()->json(['success'=>true,'data'=>['data'=>$data]]);
    }
}
