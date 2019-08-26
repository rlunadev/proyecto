@extends('admin.template.main')
@section('title','Indice usuario')
@section('content')
<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Detalle Sotck</div>
		</div>
		<div class="col-md-4">
		{!!Form::open(['route'=>'admin.users.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
		<div class="input-group">
			{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'buscar...','aria-describedby'=>'search'])!!}
			<span class="input-group-btn " >
				<button class="btn btn-primary">&nbsp;<span class="glyphicon glyphicon-search" id="searh"></span></button>
			</span>
		</div>
		{!!Form::close()!!}
		</div>
	</div>
		<table class="table table-striped">
			<thead>
				<th>Stock</th>
				<th>Periodo</th>
				<th>Item</th>
				<th>Precio</th>
				<th>Stock Inicial</th>
				<th>Stock Actual</th>
				<th>Stock Minimo</th>

				<th></th>
			</thead>
			<tbody>
				@foreach($entidad as $ent)
				<tr>
					<td>{{$ent->stockId}}</td>
					<td>{{$ent->periodoId}}</td>
					<td>{{$ent->itemId}}</td>
					<td>{{$ent->precio}}</td>
					<td>{{$ent->cantidadInicial}}</td>
					<td>{{$ent->cantidadActual}}</td>
					<td>{{$ent->stockMinimo}}</td>
					<td>
					</td>
					<td class="text-right">
						<a href="{{ route('admin.detallestock.destroy',$ent->id) }}">
							<button class="btn btn-default btn-xs text-left" onclick= "return confirm('seguro de eliminar el registro')">
								<span class="glyphicon glyphicon-trash"></span> Eliminar
							</button>
						</a>
						<a href="{{ route('admin.detallestock.edit',$ent->id)}}">
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
				    <!--{!!$entidad->count()!!}
					{!!$entidad->lastItem()!!}
					{!!$entidad->lastPage()!!}
					{!!$entidad->total()!!}
					{!!$entidad->perPage(4)!!}
					{!!$entidad->hasMorePages()!!}-->
					
					<!--{!!$entidad->currentPage()!!}
					{!!$entidad->hasMorePages()!!}
					
					{!!$entidad->nextPageUrl()!!}
					{!!$entidad->perPage()!!}
					{!!$entidad->previousPageUrl()!!}
					{!!$entidad->total()!!}
					-->

				</div>
				<div class="col-md-6 text-right">
					<a href="{{route('admin.detallestock.create')}}" class="text-right"><button class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span>Agregar</button></a>
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