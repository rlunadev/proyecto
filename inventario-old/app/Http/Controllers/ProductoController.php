<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Unidad;
use App\Categoria;
use App\Proveedor;
use App\Almacen;
use App\Http\Requests;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    public function index(Request $request)
	{
        $entity=Producto::search($request->nombre)->orderBy('id','ASC')->paginate(15);
        $entity->each(function($entity){
            $entity->unidad;
            $entity->categoria;
            $entity->proveedor;
            $entity->almacen;
        });
        
        return view('admin.producto.index')
        ->with('entidad',$entity);
	}
	public function create()
	{
        $almacen=Almacen::orderBy('nombre','DESC')->lists('nombre','id');
        $proveedor=Proveedor::orderBy('nombre','DESC')->lists('nombre','id');
        $unidad=Unidad::orderBy('nombre','DESC')->lists('nombre','id');
        $categoria=Categoria::orderBy('nombre','DESC')->lists('nombre','id');
        
        return view('admin.producto.create')
        ->with('almacen',$almacen)
        ->with('proveedor',$proveedor)
        ->with('unidad',$unidad)
        ->with('categoria',$categoria);
	}

	//Save
	public function store(ProductoRequest $request)
	{
		$entity=new Producto($request->all());
		$entity->save();
		return redirect()->route('admin.producto.index');
	}

	public function show($id)
	{
		
	}

	public function edit($id)
	{
        $entity=Producto::find($id);
        $almacen=Almacen::orderBy('nombre','DESC')->lists('nombre','id');
        $categoria=Categoria::orderBy('nombre','DESC')->lists('nombre','id');
        $unidad=Unidad::orderBy('nombre','DESC')->lists('nombre','id');
        $proveedor=Proveedor::orderBy('nombre','DESC')->lists('nombre','id');
        return view('admin.producto.edit')
        ->with('entidad',$entity)
        ->with('almacen',$almacen)
        ->with('categoria',$categoria)
        ->with('unidad',$unidad)
        ->with('proveedor',$proveedor);
	}

	public function update(Request $request,$id)
	{
		$entity=Producto::find($id);
		$entity->fill($request->all());
		$entity->save();
		return redirect()->route('admin.producto.index');
	}

	public function destroy($id)
	{
		$entity=Producto::find($id);
		$entity->delete();
		return redirect()->route('admin.producto.index');
	}
}
