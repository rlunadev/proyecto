@extends('admin.template.main')
@section('title','Crear')
@section('content')
	
	<div class="box-header with-border">
      <h3 class="box-title">Proveedor</h3>
    </div>
		{!! Form::open(['route'=>'admin.proveedor.store','method'=>'POST','class'=>'box-body']) !!}
	<div class="form-group">
		{!! Form::label('nombre','Nombre') !!}
		{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
	</div>

	<div class="form-group">
	{!! Form::label('vendedor','Vendedor') !!}
	{!! Form::text('vendedor',null,['class'=>'form-control','placeholder'=>'nombre de vendedor','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('telefono','Telefono') !!}
		{!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Telefono','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('direccion','Direccion') !!}
		{!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'direccion','required']) !!}
	</div>

	<div class="div-group">
		{!!Form::submit('registrar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
	</div>
@endsection
