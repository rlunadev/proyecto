@extends('admin.template.main')
@section('title','Crea Usuario')
@section('content')
	<div class="container jumbotron" >
		{!! Form::open(['route'=>'admin.users.store','method'=>'POST']) !!}
	<div class="form-group">
		{!! Form::label('name','Nombre') !!}
		{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre Completo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email','E-mail') !!}
		{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'examplegmail.com','required']) !!}
	</div>

	 <div class="form-group">
		{!! Form::label('password','Contraseña') !!}
		{!! Form::password('password',['class'=>'form-control','placeholder'=>'****','required']) !!}
	</div>
	<div class="div-group">
		{!!Form::submit('registrar',['class'=>'btn btn-primary'])!!}
	</div>
{!! Form::close() !!}
	</div>
@endsection
