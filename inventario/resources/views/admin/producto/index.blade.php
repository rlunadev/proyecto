@extends('admin.template.main')
@section('title','Indice usuario')
@section('content')
<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Productos</div>
		</div>
		{!!Form::open(['route'=>'admin.producto.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
	<div class="input-group">
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'buscar almacen','aria-describedby'=>'search'])!!}
		<span class="input-group-addon glyphicon glyphicon-search" id="searh"></span>
	</div>
	{!!Form::close()!!}
	</div>
		<table class="table table-striped">
			<thead>
				<th>Nombre</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Codigo</th>
				<th>Stock Minimo</th>
				<th>Unidad</th>
				<th>Categoria</th>
				<th>Proveedor</th>
				<th>Almacen</th>
			</thead>
			<tbody>
				@foreach($entidad as $item)
				<tr>
					<td>{{$item->nombre}}</td>
					<td>{{$item->cantidad}}</td>
					<td>{{$item->precio}}</td>
					<td>{{$item->codigo}}</td>
					<td>{{$item->stockMinimo}}</td>
					<td>{{$item->unidad->nombre}}</td>
					<td>{{$item->categoria->nombre}}</td>
					<td>{{$item->proveedor->nombre}}</td>
					<td>{{$item->almacen->nombre}}</td>
					<td class="text-right">
						<a href="{{route('admin.producto.destroy',$item->id)}}" class="btn btn-default btn-xs text-left" onclick= "return confirm('seguro de eliminar el registro')">
						 
								<span class="glyphicon glyphicon-trash"></span> Eliminar
						 
						</a>
						<a href="{{route('admin.producto.edit',$item->id)}}">
							<button class="btn btn-default btn-xs">
						 		<span class="glyphicon glyphicon-edit"></span> Editar
							</button>
						</a>
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="panel-footer" >
				<div class="col-md-6">
					{!!$entidad->render()!!}	
				</div>
				<div class="col-md-6 text-right">
					<a href="{{route('admin.producto.create')}}" class="text-right"><button class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span>Agregar</button></a>
				</div>
			<br><br>
		</div>
</div>
@endsection
<script src="{{asset('bootstrap/js/jquery-2.1.1.min.js')}}"></script>
<script>
 $(document).ready(function () {
    $(".pagination").css('margin','0');
 });
</script>