<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Estado_Financiero;

class EstadoFinancieroController extends Controller
{
    public function store(Request $request) {
    	$estadofinanciero = new Estado_Financiero($request->all());
    	$estadofinanciero->save();
    	return redirect()->route('admin.estadofinanciero.index');
    }

    public function index() {
    	$estadofinanciero=Estado_Financiero::orderBy('id','ASC')->paginate(12);
    	return view('admin.estadofinanciero.index')->with('estadofinanciero',$estadofinanciero);
    }

    public function create() {
    	return view('admin.estadofinanciero.create');
    }

    public function edit($id) {
    	$estadofinanciero=Estado_Financiero::find($id);
        return view('admin.estadofinanciero.edit')->with('estadofinanciero',$estadofinanciero);
    }

    public function update (Request $request, $id) {
        $estadofinanciero=Estado_Financiero::find($id);
        $estadofinanciero->descripcion=$request->descripcion;
        $estadofinanciero->save();
        return redirect()->route('admin.estadofinanciero.index');
    }

    public function destroy ($id) {
         $estadofinanciero=Estado_Financiero::find($id);
         $estadofinanciero->delete();
         return redirect()->route('admin.estadofinanciero.index');
    }
    public function show($id){

    }
}
