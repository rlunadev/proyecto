<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Requests\CicloRequest;
use App\Ciclo;

class CiclosController extends Controller
{
	public function store(Request $request) {
    	$ciclo = new Ciclo($request->all());
    	$ciclo->save();
    	return redirect()->route('admin.ciclos.index');
    }
    
    public function index() {
    	$ciclos=Ciclo::orderBy('id','ASC')->paginate(12);
    	return view('admin.ciclos.index')->with('ciclos',$ciclos);
    }

    public function create() {
    	return view('admin.ciclos.create');
    }

    public function edit($id) {
    	$ciclos=Ciclo::find($id);
        return view('admin.ciclos.edit')->with('ciclo',$ciclos);
    }

    public function update (Request $request, $id) {
        $ciclos=Ciclo::find($id);
        $ciclos->descripcion=$request->descripcion;
        $ciclos->precio=$request->precio;
        $ciclos->save();
        return redirect()->route('admin.ciclos.index');
    }

    public function destroy ($id) {
         $ciclo=Ciclo::find($id);
         $ciclo->delete();
         return redirect()->route('admin.ciclos.index');
    }
    public function show($id){

    }
}
