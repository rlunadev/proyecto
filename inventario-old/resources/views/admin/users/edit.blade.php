@extends('admin.template.main')

@section('title','Editar Usuario'.$user->name)

@section('content')
	{!! Form::open(['route'=>['admin.users.update',$user],'method'=>'put']) !!}
	<div class="form-group">
		{!! Form::label('name','Nombre') !!}
		{!! Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Nombre Completo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email','E-mail') !!}
		{!! Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'examplegmail.com','required']) !!}
	</div>
	
	<div class="form-group">
		{!!Form::label('type','Tipo')!!}
		{!!Form::select('type',['member'=>'Miembro','admin'=>'Administrador'],$user->type,['class'=>'form-control'])!!}
	</div>
	<div class="div-group">
		{!!Form::submit('Editar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
@endsection