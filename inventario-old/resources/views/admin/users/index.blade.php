@extends('admin.template.main')
@section('title','Indice usuario')
@section('content')
<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Usuarios</div>
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
				<th>Nombre</th>
				<th>E-mail</th>
				<th></th>
				<th>Tipo</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<!--<td>{{$user->id}}</td>-->
					<td>
					<!--<a href="{{ route('admin.users.edit',$user->id)}}">-->
						{{$user->name}}
					<!--</a>-->
					</td>
					<td>{{$user->email}}</td>
					<td></td>
					@if($user->type=="admin")
						<td><span class="label label-danger">{{$user->type}}</span></td>
					@else
						<td><span class="label label-primary">{{$user->type}}</span></td>
					@endif
					<td>
					</td>
					<td class="text-right">
						<a href="{{ route('admin.users.destroy',$user->id) }}">
							<button class="btn btn-default btn-xs text-left" onclick= "return confirm('seguro de eliminar el registro')">
								<span class="glyphicon glyphicon-trash"></span> Eliminar
							</button>
						</a>
						<a href="{{ route('admin.users.edit',$user->id)}}">
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
					{!!$users->render()!!}	
				    <!--{!!$users->count()!!}
					{!!$users->lastItem()!!}
					{!!$users->lastPage()!!}
					{!!$users->total()!!}
					{!!$users->perPage(4)!!}
					{!!$users->hasMorePages()!!}-->
					
					<!--{!!$users->currentPage()!!}
					{!!$users->hasMorePages()!!}
					
					{!!$users->nextPageUrl()!!}
					{!!$users->perPage()!!}
					{!!$users->previousPageUrl()!!}
					{!!$users->total()!!}
					-->

				</div>
				<div class="col-md-6 text-right">
					<a href="{{route('admin.users.create')}}" class="text-right"><button class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span>Agregar</button></a>
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