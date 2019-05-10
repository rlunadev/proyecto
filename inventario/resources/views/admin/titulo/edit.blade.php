@extends('admin.template.main')

@section('title','Editar '.$estadofinanciero->nombre)

@section('content')
	{!! Form::open(['route'=>['admin.estadofinanciero.update',$estadofinanciero],'method'=>'put']) !!}
	<div class="form-group">
		{!! Form::label('descripcion','Modalidad') !!}
		{!! Form::text('descripcion',$estadofinanciero->descripcion,['class'=>'form-control','placeholder'=>'','required']) !!}
	</div>

	<div class="div-group">
		{!!Form::submit('Editar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
@endsection