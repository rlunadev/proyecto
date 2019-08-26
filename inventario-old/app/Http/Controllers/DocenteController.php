<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Docente;

class DocenteController extends Controller
{
    public function store(Request $request) {
    	$docente = new Docente($request->all());
    	$docente->save();
    	return redirect()->route('admin.docente.index');
    }

    public function index() {
    	$docente=Docente::orderBy('id','ASC')->paginate(12);
    	return view('admin.docente.index')->with('docente',$docente);
    }

    public function create() {
    	return view('admin.docente.create');
    }

    public function edit($id) {
    	$docente=Docente::find($id);
        return view('admin.docente.edit')->with('docente',$docente);
    }

    public function update (Request $request, $id) {
        $docente=Docente::find($id);
        $docente->nombres=$request->nombres;
        $docente->apellidos=$request->apellidos;
        $docente->telefono=$request->telefono;
        $docente->email=$request->email;
        $docente->domicilio=$request->domicilio;
        $docente->save();
        return redirect()->route('admin.docente.index');
    }

    public function destroy ($id) {
         $docente=Docente::find($id);
         $docente->delete();
         return redirect()->route('admin.docente.index');
    }
    public function show($id){

    }
}
