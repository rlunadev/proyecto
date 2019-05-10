<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Asistencia;
use App\Alumno;
use App\Docente;


class AsistenciaController extends Controller
{
    public function store(Request $request) {
    	$asistencia = new Asistencia($request->all());
    	$asistencia->save();
    	return redirect()->route('admin.asistencia.index');
    }

    public function index() {
    	$asistencia=Asistencia::orderBy('id','ASC')->paginate(12);
        $docente=Docente::all();
        $alumno=Alumno::orderBy('id','ASC')->paginate(12);
         $asistencia->each(function($asistencia){
            $asistencia->curso_docente;
            $asistencia->alumno;
        });
    	return view('admin.asistencia.index')
        ->with('asistencia',$asistencia)
        ->with('alumno',$alumno)
        ->with('docente',$docente);
    }

    public function create() {
    	return view('admin.asistencia.create');
    }

    public function edit($id) {
    	$asistencia=Asistencia::find($id);
        return view('admin.asistencia.edit')->with('asistencia',$asistencia);
    }

    public function update (Request $request, $id) {
        $asistencia=Asistencia::find($id);
        // $asistencia->nombres=$request->nombres;
        // $asistencia->apellidos=$request->apellidos;
        // $asistencia->telefono=$request->telefono;
        // $asistencia->email=$request->email;
        // $asistencia->domicilio=$request->domicilio;
        $asistencia->save();
        return redirect()->route('admin.asistencia.index');
    }

    public function destroy ($id) {
         $asistencia=Asistencia::find($id);
         $asistencia->delete();
         return redirect()->route('admin.asistencia.index');
    }
    public function show($id){

    }
}
