@extends('admin.template.main')

@section('title','Editar '.$entidad->nombre)

@section('content')
<div class="box-header with-border">
      <h3 class="box-title">Entidad</h3>
    </div>
	{!! Form::open(['route'=>['admin.proveedor.update',$entidad],'method'=>'put','class'=>'box-body']) !!}
	<div class="form-group">
	{!! Form::label('nombre','Nombre') !!}
	{!! Form::text('nombre',$entidad->nombre,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
	</div>

	<div class="form-group">
	{!! Form::label('vendedor','Vendedor') !!}
	{!! Form::text('vendedor',$entidad->vendedor,['class'=>'form-control','placeholder'=>'nombre de vendedor','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('telefono','Telefono') !!}
		{!! Form::text('telefono',$entidad->telefono,['class'=>'form-control','placeholder'=>'Telefono','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('direccion','Direccion') !!}
		{!! Form::text('direccion',$entidad->direccion,['class'=>'form-control','placeholder'=>'direccion','required']) !!}
	</div>
	
	<div class="div-group">
		{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
@endsection