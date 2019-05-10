@extends('admin.template.main')
@section('title','Agregar Producto')

@section('content')
    <div class="box-header with-border">
      <h3 class="box-title"> Producto</h3>
    </div>
{!!Form::open(['route'=>'admin.producto.store','method'=>'POST','class'=>'box-body'])!!}
	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('nombre','Nombre',['class'=>'text-left'])!!}
			{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('cantidad','Cantidad',['class'=>'text-left'])!!}
			{!!Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('precio','Precio',['class'=>'text-left'])!!}
			{!!Form::text('precio',null,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
	</div>
	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('codigo','Codigo')!!}
			{!!Form::text('codigo',null,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('stockMinimo','Stock Minimo')!!}
			{!!Form::text('stockMinimo',null,['class'=>'form-control','placeholder'=>'','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
		{!!Form::label('almacenId','Almacen')!!}
			{!!Form::select('almacenId',$almacen,null,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
	</div>

	<div class="col-md-12 form-inline" style="margin-bottom:10px">
		<div class="col-md-4 form-group text-right">
			{!!Form::label('unidadId','Unidad')!!}
			{!!Form::select('unidadId',$unidad,null,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('categoriaId','Categoria')!!}
			{!!Form::select('categoriaId',$categoria,null,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
		<div class="col-md-4 form-group text-right">
			{!!Form::label('proveedorId','Proveedor')!!}
			{!!Form::select('proveedorId',$proveedor,null,['class'=>'form-control','placeholder'=>' -- Seleccione Opcion -- ','required'])!!}
		</div>
	</div>
	
	<div class="col-md-12 form-inline">
		<div class="text-right">
		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
		</div>
	</div>
{!!Form::close()!!}
@endsection