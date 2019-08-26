@extends('admin.template.main')
@section('title','lista de tag')

@section('content')
<a href="{{route('admin.tags.create')}}"><button class="btn btn-success">NUEVO IDIOMA</button></a>
<!-- buscador tag -->
{!!Form::open(['route'=>'admin.tags.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
	<div class="input-group">
		{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'BUSCAR IDIOMA','aria-describedby'=>'search'])!!}
		<button type="submit"><span class="input-group-addon glyphicon glyphicon-search" id="searh"></span></button>
	</div>
{!!Form::close()!!}
<!-- fin buscador tag -->
<table class="table table-striped">
	<thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Accion</th>
	</thead>
	<tbody>
		@foreach($tags as $tag)
		<tr>
			<td>{{$tag->id}}</td>
			<td>{{$tag->name}}</td>
			<td>
				<a href="{{route('admin.tags.edit',$tag->id) }}" class="btn btn-warning">
					<span class="glyphicon glyphicon-wrench"></span>
				</a>
				<a href="{{route('admin.tags.destroy',$tag->id) }}" class="btn btn-danger" onclick= "return confirm('seguro de eliminar el registro')">
					<span class="glyphicon glyphicon-remove-circle"></span>
				</a>
			</td>
		</tr>
		<tr></tr>
		@endforeach
	</tbody>
</table>
<div class="text-center">
	{!!$tags->render()!!}
</div>
@endsection