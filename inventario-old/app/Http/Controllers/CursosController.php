<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Curso;
use App\Ciclo;

class CursosController extends Controller
{
      public function store(Request $request) {
    	$cursos = new Curso($request->all());
    	$cursos->save();
    	return redirect()->route('admin.cursos.index');
    }

    public function index() {
    	$cursos = Curso::orderBy('id','DESC')->paginate(10);
        $cursos->each(function($cursos){
            $cursos->ciclo;
        });
         //dd($cursos);
    	return view('admin.cursos.index')->with('cursos',$cursos);
    }

    public function create() {
        $ciclo=Ciclo::orderBy('descripcion','ASC')->lists('descripcion','id');
        return view('admin.cursos.create')
        ->with('ciclo',$ciclo);    	
    }

    public function edit($id) {
        $cursos=Curso::find($id);
        $ciclo=Ciclo::orderBy('descripcion','DESC')->lists('descripcion','id');
        return view('admin.cursos.edit')
        ->with('ciclo',$ciclo)
        ->with('cursos',$cursos);
    }

    public function update (Request $request, $id) {  
        $cursos=Curso::find($id);
        $cursos->fill($request->all());
        $cursos->save();
       return redirect()->route('admin.cursos.index');
    }
//Flash::warning('Articulo '.$articles->title.'Editado');
    public function destroy ($id) {
         $cursos=Curso::find($id);
         $cursos->delete();
         return redirect()->route('admin.cursos.index');
    }
    public function show($id){

    }
}

