@extends('admin.template.main')
@section('title','Agregar Almacen')

@section('content')
    <div class="box-header with-border">
      <h3 class="box-title"> Almacen</h3>
    </div>
{!!Form::open(['route'=>'admin.almacen.store','method'=>'POST','class'=>'box-body'])!!}
	<div class="form-group">
		{!!Form::label('nombre','Nombre')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('ubicacion','Ubicacion')!!}
		{!!Form::text('ubicacion',null,['class'=>'form-control','placeholder'=>'','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('descripcion','Descripcion')!!}
		{!!Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('empresaId','Empresa')!!}
		{!!Form::select('empresaId',$empresa,null,['class'=>'form-control','placeholder'=>'--Seleccione Empresa --','required'])!!}
	</div>
	
	

	<div class="form-group">
		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	</div>
{!!Form::close()!!}
@endsection