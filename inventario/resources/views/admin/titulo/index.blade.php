@extends('admin.template.main')
@section('title','Modalidad')
@section('content')
<h3 class="text-center">Modalidad</h3>
<a href="{{route('admin.estadofinanciero.create')}}">
<button class="btn btn-success">Registrar</button>
</a>
<table class="table table-striped">
	<thead>
		<th>Descripción</th>
	</thead>
	<tbody>
		@foreach($estadofinanciero as $est)
		<tr>
			<td>{{$est->descripcion}}</td>
			<td>
				<a href="{{ route('admin.estadofinanciero.destroy',$est->id) }}"><button class="btn btn-danger" onclick= "return confirm('seguro de eliminar el registro')">Eliminar</button></a>
				<a href="{{ route('admin.estadofinanciero.edit',$est->id) }}"><button class="btn btn-warning">Editar</button></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!!$estadofinanciero->render()!!}
@endsection