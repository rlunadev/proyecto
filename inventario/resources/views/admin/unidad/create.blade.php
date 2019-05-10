@extends('admin.template.main')
@section('title','Crea Usuario')
@section('content')
	<div class="box-header with-border">
      <h3 class="box-title">Unidad</h3>
    </div>
		{!! Form::open(['route'=>'admin.unidad.store','method'=>'POST','class'=>'box-body']) !!}
	<div class="form-group">
		{!! Form::label('nombre','Nombre') !!}
		{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'nombre','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('valor','Valor') !!}
		{!! Form::text('valor',null,['class'=>'form-control','placeholder'=>'valor','required']) !!}
	</div>

	<div class="form-group">
	{!! Form::label('descripcion','Descripcion') !!}
	{!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'descripcion','required']) !!}
</div>
	<div class="div-group">
		{!!Form::submit('registrar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
@endsection
