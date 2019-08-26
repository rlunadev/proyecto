@extends('admin.template.main')
@section('title','add modalidad')
@section('content')
{!! Form::open(['route'=>'admin.estadofinanciero.store','method'=>'POST']) !!}
	<div class="form-group">
		{!! Form::label('descripcion','Modalidad') !!}
		{!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'','required']) !!}
	</div>
	
		{!! Form::Submit('Registrar',null,['class'=>'btn btn-primary'])!!}
	
{!! Form::close() !!}
@endsection