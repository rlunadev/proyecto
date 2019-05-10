<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests\AlmacenRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Almacen;
use App\Empresa;
use Javascript;
class AlmacenController extends Controller {

	public function index(Request $request)
	{
		$almacen=Almacen::search($request->nombre)->orderBy('id','DESC')->paginate(10);
		$almacen->each(function($almacen){
			$almacen->empresa;
		});
		
		return view('admin.almacen.index')->with('almacenes',$almacen);
	}

	public function create()
	{
		$empresa=Empresa::orderBy('nombre','DESC')->lists('nombre','id');
		return view('admin.almacen.create')
		->with('empresa',$empresa);
	}
	public function test(){
		return response()->json(['success'=>true]);
	}

	//Save
	public function store(Request $request)
	{
		$tag=new Almacen($request->all());
		$tag->save();
		return redirect()->route('admin.almacen.index');
	}

	public function show($id)
	{
		
	}

	public function edit($id)
	{
		$almacen=Almacen::find($id);
		$empresa=Empresa::orderBy('nombre','DESC')->lists('nombre','id');

		return view('admin.almacen.edit')
		->with('almacen',$almacen)
		->with('empresa',$empresa);
	}

	public function update(Request $request,$id)
	{
		$almacen=Almacen::find($id);
		$almacen->fill($request->all());
		$almacen->save();
		return redirect()->route('admin.almacen.index');
	}

	public function destroy($id)
	{
		$alm=Almacen::find($id);
		$alm->delete();
		return redirect()->route('admin.almacen.index');
	}

}
