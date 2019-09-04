
@extends('template.main')
@section('title','Indice usuario')
@section('content')
	
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<h3>Resumen de Stock</h3>

{{-- ultimas Salidas --}}
  <div class="box box-info">
	<div class="box-header with-border">
	  <h3 class="box-title">ULTIMAS SALIDAS DE PRODUCTOS</h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
	  </div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="table-responsive">
		<table class="table no-margin" id="tablaSalidas">
		  <thead>
		  <tr>
			<th>Nombre Item</th>
			<th>Fecha Salida</th>
			<th>Estado</th>
			<th>Cantidad</th>
			<th>Total</th>
		  </tr>
		  </thead>
		  <tbody>
		 
		  </tbody>
		</table>
	  </div>
	  <!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
	  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right">Ver Todos los productos</a>
	</div>
	<!-- /.box-footer -->
  </div>

  
{{-- ultimos registros --}}
  <div class="box box-info">
	<div class="box-header with-border">
			<h3 class="box-title">ULTIMOS PRODUCTOS REGISTRADOS</h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
	  </div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="table-responsive">
		<table class="table no-margin" id="ultimosRegistros">
		  <thead>
		  <tr>
			<th>Nombre Item</th>
			<th>Categoria</th>
			<th>Unidad</th>
			<th>Cantidad</th>
			<th>Total Bs.</th>
		  </tr>
		  </thead>
		  <tbody>
		 
		  </tbody>
		</table>
	  </div>
	  <!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
	  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right">Ver Todas las Salidas</a>
	</div>
	<!-- /.box-footer -->
  </div>


  <script>
  getUltimasSalidas();
  function getUltimasSalidas(){
    $.ajax({
      type: 'GET',
      url:{!!json_encode(url('/'))!!}+"/api/salidaDetalle/GetUltimasSalida?token="+localStorage.getItem('token'),
      success: function(result) {
		  lista = result.data
		  var items ="";
		for (let i = 0; i < lista.length; i++) {
			items = items + 
			`<tr>
				<td>${lista[i].nombre_producto}</td>
				<td>${lista[i].created_at}</td>
				<td><span class="label label-${lista[i].status == 1 ?'success': 'danger'}">${lista[i].status == 1 ?'Completado': 'No Completado'}</span></td>
				<td>${lista[i].cantidad}</td>
				<td>${lista[i].subTotal}</td>
		  	 </tr>`;
		}
		$("#tablaSalidas tbody").append(items);
      },
      error: function(e) {}
    });
  }


  getUltimosAgregados();
  function getUltimosAgregados(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/GetUltimosAgregados?token="+localStorage.getItem('token'),
      data:{data:2},
      success: function(result) {
		  lista = result.data
		  var items ="";
		for (let i = 0; i < lista.length; i++) {
			items = items + 
			`<tr>
				<td>${lista[i].nombre}</td>
				<td>${lista[i].categoria.nombre}</td>
				<td>${lista[i].unidad.descripcion} </td>
				<td>${lista[i].cantidad}</td>
				<td>${lista[i].cantidad}</td>
		  	 </tr>`;
		}
		$("#ultimosRegistros tBody").append(items);
      },
      error: function(e) {}
    });
  }


  </script>
@endsection
