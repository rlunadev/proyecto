@extends('template.main')
@section('title','Crea Usuario')
@section('content')
	 <div class="box-header with-border">
      <h3 class="box-title"> Almacen</h3>
    </div>
		{!! Form::open(['route'=>'users.store','method'=>'POST','class'=>'box-body']) !!}
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
@endsection
