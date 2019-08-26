<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\DetalleStock;

class DetalleStockController extends Controller
{
     public function index(Request $request)
	{
		
	  	//$cat=Categoria::search($request->nombre)->orderBy('id','ASC')->paginate(12);
	  	//dd($cat);
		$entity=DetalleStock::orderBy('id','ASC')->paginate(15);
		return view('admin.detallestock.index')->with('entidad',$entity);
	}
	public function create()
	{
		return view('admin.detallestock.create');
	}

	//Save
	public function store(CategoriaRequest $request)
	{
		$entity=new DetalleStock($request->all());
		$entity->save();
		return redirect()->route('admin.detallestock.index');
	}

	public function show($id)
	{
		
	}

	public function edit($id)
	{
		$entity=DetalleStock::find($id);
		return view('admin.detallestock.edit')->with('entidad',$entity);
	}

	public function update(Request $request,$id)
	{
		$entity=DetalleStock::find($id);
		$entity->fill($request->all());
		$entity->save();
		return redirect()->route('admin.detallestock.index');
	}

	public function destroy($id)
	{
		$entity=Categoria::find($id);
		$entity->delete();
		return redirect()->route('admin.detallestock.index');
	//return view('admin.Almacen.index')->with('almacenes',$cat);
	}
}
