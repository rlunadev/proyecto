<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class restController extends Controller
{
    public function store(Request $request) {
    return response()->json([
            "success"=>true,
            ]);
    }
    
    public function create() {
    	return ('creado');
    }
    public function getById($id) {
    	$user=User::find($id);
    	return (json_encode($user));
    }
    public function index() {
    	return (json_encode($users=user::all()));
    }
    public function update(Request $request, $id)
    {
        //$this->persona->fill($request->all());
        //$this->persona->save();
        return response()->json([
                "success"=>true
            ]);
    }
    public function destroy ($id) {
         return response()->json([
                "success"=>true
            ]);
    }
}
