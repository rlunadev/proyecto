<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Periodo;
class PeriodoController extends Controller
{
     public function index(Request $request)
	{
	  	//$cat=Categoria::search($request->nombre)->orderBy('id','ASC')->paginate(12);
	  	//dd($cat);
		$entity=Periodo::orderBy('id','ASC')->paginate(15);
		return view('admin.periodo.index')->with('entidad',$entity);
	}
	public function create()
	{
		return view('admin.periodo.create');
	}

	//Save
	public function store(CategoriaRequest $request)
	{
		$entity=new Periodo($request->all());
		$entity->save();
		return redirect()->route('admin.periodo.index');
	}

	public function show($id)
	{
		
	}

	public function edit($id)
	{
		$entity=Periodo::find($id);
		return view('admin.periodo.edit')->with('entidad',$entity);
	}

	public function update(Request $request,$id)
	{
		$entity=Periodo::find($id);
		$entity->fill($request->all());
		$entity->save();
		return redirect()->route('admin.periodo.index');
	}

	public function destroy($id)
	{
		$entity=Periodo::find($id);
		$entity->delete();
		return redirect()->route('admin.periodo.index');
	//return view('admin.Almacen.index')->with('almacenes',$cat);
	}
}
