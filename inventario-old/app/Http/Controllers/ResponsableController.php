<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Responsable;


class ResponsableController extends Controller
{
    public function store(Request $request) {
    	$responsable = new Responsable($request->all());
    	$responsable->save();
    	return redirect()->route('admin.responsable.index');
    }

    public function index() {
    	$responsable=Responsable::orderBy('id','ASC')->paginate(12);
        /* $responsable->each(function($responsable){
            $responsable->user;
            $responsable->alumno;
        });*/
         //dd($responsable);
    	return view('admin.responsable.index')->with('responsable',$responsable);
    }

    public function create() {
    	return view('admin.responsable.create');
    }

    public function edit($id) {
    	$responsable=Responsable::find($id);
        return view('admin.responsable.edit')->with('responsable',$responsable);
    }

    public function update (Request $request, $id) {
        $responsable=Responsable::find($id);
        $responsable->fill($request->all());
        $responsable->save();
        return redirect()->route('admin.responsable.index');
    }

    public function destroy ($id) {
         $responsable=Responsable::find($id);
         $responsable->delete();
         return redirect()->route('admin.responsable.index');
    }
    public function show($id){

    }
}
