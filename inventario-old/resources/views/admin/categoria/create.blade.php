@extends('admin.template.main')
@section('title','Crear')
@section('content')
	
	<div class="box-header with-border">
      <h3 class="box-title">Categoria</h3>
    </div>
		{!! Form::open(['route'=>'admin.categoria.store','method'=>'POST','class'=>'box-body']) !!}
	<div class="form-group">
		{!! Form::label('nombre','Nombre') !!}
		{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('descripcion','descripcion') !!}
		{!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'descripcion']) !!}
	</div>

	<div class="div-group">
		{!!Form::submit('registrar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
	</div>
@endsection
