@extends('admin.template.main')
@section('title','edit Almacen')

@section('content')
	<div class="box-header with-border">
      <h3 class="box-title">Actualizar Almacen</h3>
    </div>
{!!Form::open(['route'=>['admin.almacen.update',$almacen],'method'=>'PUT','class'=>'box-body'])!!}
	<div class="form-group">
		{!!Form::label('nombre','Nombre')!!}
		{!!Form::text('nombre',$almacen->nombre,['class'=>'form-control','placeholder'=>'Nombre de Almacen','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('ubicacion','Ubicacion')!!}
		{!!Form::text('ubicacion',$almacen->ubicacion,['class'=>'form-control','placeholder'=>'Ubicacion','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('descripcion','Descripcion')!!}
		{!!Form::text('descripcion',$almacen->descripcion,['class'=>'form-control','placeholder'=>'Descripcion','required'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('empresaId','Empresa')!!}
		{!!Form::select('empresaId',$empresa,$almacen->empresa->id,['class'=>'form-control','placeholder'=>'-- Seleccione Empresa --','required'])!!}
	</div>

	<div class="form-group">
		{!!Form::submit('Editar',['class'=>'btn btn-primary'])!!}
	</div>
{!!Form::close()!!}
@endsection