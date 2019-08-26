@extends('admin.template.main')

@section('title','Editar '.$categoria->nombre)

@section('content')
<div class="box-header with-border">
      <h3 class="box-title">Categoria</h3>
    </div>
	{!! Form::open(['route'=>['admin.categoria.update',$categoria],'method'=>'put','class'=>'box-body']) !!}
	<div class="form-group">
		{!! Form::label('nombre','Nombre') !!}
		{!! Form::text('nombre',$categoria->nombre,['class'=>'form-control','placeholder'=>'Nombre Completo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('descripcion','descripcion') !!}
		{!! Form::text('descripcion',$categoria->descripcion,['class'=>'form-control','placeholder'=>'examplegmail.com','required']) !!}
	</div>
	
	
	<div class="div-group">
		{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
@endsection