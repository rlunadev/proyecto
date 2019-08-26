@extends('admin.template.main')
@section('title','edit Producto')

@section('content')
<div class="box-header with-border">
      <h3 class="box-title">Actualizar Productos</h3>
    </div>
{!!Form::open(['route'=>['admin.producto.update',$entidad],'method'=>'PUT','class'=>'box-body'])!!}

	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('nombre','Nombre',['class'=>'text-left'])!!}
			{!!Form::text('nombre',$entidad->nombre,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('cantidad','Cantidad',['class'=>'text-left'])!!}
			{!!Form::text('cantidad',$entidad->cantidad,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('precio','Precio',['class'=>'text-left'])!!}
			{!!Form::text('precio',$entidad->precio,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
	</div>
	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('codigo','Codigo')!!}
			{!!Form::text('codigo',$entidad->codigo,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('stockMinimo','Stock Minimo')!!}
			{!!Form::text('stockMinimo',$entidad->stockMinimo,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
		{!!Form::label('almacenId','Almacen')!!}
			{!!Form::select('almacenId',$almacen,$entidad->almacen->id,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
	</div>

	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('unidadId','Unidad')!!}
			{!!Form::select('unidadId',$unidad,$entidad->unidad->id,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('categoriaId','Categoria')!!}
			{!!Form::select('categoriaId',$categoria,$entidad->categoria->id,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('proveedorId','Proveedor')!!}
			{!!Form::select('proveedorId',$proveedor,$entidad->proveedor->id,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
	</div>
	
	<div class="col-md-12 form-inline">
		<div class="text-left">
		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
		</div>
	</div>
{!!Form::close()!!}
@endsection