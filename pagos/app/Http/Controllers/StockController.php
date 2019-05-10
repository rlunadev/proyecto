<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Stock;
class StockController extends Controller
{
     public function index(Request $request)
	{
	  	//$cat=Categoria::search($request->nombre)->orderBy('id','ASC')->paginate(12);
	  	//dd($cat);
		$entity=Stock::orderBy('id','ASC')->paginate(15);
		return view('admin.stock.index')->with('entidad',$entity);
	}
	public function create()
	{
		return view('admin.stock.create');
	}

	//Save
	public function store(CategoriaRequest $request)
	{
		$entity=new Stock($request->all());
		$entity->save();
		return redirect()->route('admin.stock.index');
	}

	public function show($id)
	{
		
	}

	public function edit($id)
	{
		$entity=Stock::find($id);
		return view('admin.stock.edit')->with('entidad',$entity);
	}

	public function update(Request $request,$id)
	{
		$entity=Stock::find($id);
		$entity->fill($request->all());
		$entity->save();
		return redirect()->route('admin.stock.index');
	}

	public function destroy($id)
	{
		$entity=Stock::find($id);
		$entity->delete();
		return redirect()->route('admin.stock.index');
	//return view('admin.Almacen.index')->with('almacenes',$cat);
	}
}
