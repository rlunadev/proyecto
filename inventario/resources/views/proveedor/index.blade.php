
@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Empresa</div>
		</div>
		<div class="col-md-4">
        
		</div>
	</div>
		<div>
		
	    <div class="box">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Vendedor</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

		<div class="panel-footer" >
				<div class="col-md-6">
					
				</div>
				<div class="col-md-6 text-right">
					<button class="btn btn-primary" data-toggle='modal' data-target='#modal-add'> <span class="glyphicon glyphicon-plus"></span>Agregar</button>
				</div>
			<br><br>
		</div>
</div>
@endsection

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2()
 });
 getAll();
 
 //Get all Users
function getAll(){
	$.ajax({
		type: 'GET',
		url:{!!json_encode(url('/'))!!}+"/api/proveedor/GetAll?token="+localStorage.getItem('token'),
		success: function(result) {
			$.each(result.data, function() {
				$.each(this, function(index, value) {
            		var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.nombre + "</td><td>" + value.vendedor+" </td><td>" + value.telefono+" </td><td>" + value.direccion+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Edit </button> <button type='button' class='btn btn-default btn-sm'  onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
					$("#table1 tbody").append(newItem);
				});
			});
      $('#table1').DataTable()
		},
		error: function(e) {}
	});
}
// Delete By Id
function deleteById (id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/proveedor/DeleteById?token="+localStorage.getItem('token'),
    data:{
      id:id
    },
		success: function(result) {
		  console.log(result);
		},
		error: function(e) {}
	});
}
//Save Data
function SaveData (nombre,vendedor,telefono,direccion){
  console.log(nombre,vendedor,telefono,direccion);
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/proveedor/SaveData?token="+localStorage.getItem('token'),
    data:{
      nombre:nombre,
      vendedor:vendedor,
      telefono:telefono,
      direccion:direccion
    },
		success: function(result) {
      var newItem = $("<tr  id='trId_"+result.result.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" +result.result.nombre + "</td><td>" + result.result.vendedor+" </td><td>" + result.result.telefono+" </td><td>" + result.result.direccion+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='editFromTable("+result.result.id+")' data-href='"+result.result.id+"'  data-toggle='modal' data-target='#modal-edit' > Edit </button> <button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+result.result.id+")' data-href='"+result.result.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
					$("#table1 tbody").append(newItem);
          clear();
		},
		error: function(e) {}
	});
}
//Get By Id 
function GetById (id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/proveedor/GetById?token="+localStorage.getItem('token'),
    data:{
      id:id
    },
		success: function(result) {
      $("#nombreEdit").val(result.data.data.nombre);
      $("#vendedorEdit").val(result.data.data.vendedor);
      $("#telefonoEdit").val(result.data.data.telefono);
      $("#direccionEdit").val(result.data.data.direccion);
		},
		error: function(e) {}
	});
}
//Update
function update (nombre,vendedor,telefono,direccion){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/proveedor/Update?token="+localStorage.getItem('token'),
    data:{
      id:auxId,
      nombre:nombre,
      vendedor:vendedor,
      telefono:telefono,
      direccion:direccion
    },
		success: function(result) {
      $('#trId_' + result.data.id).find("td").eq(0).html(result.data.nombre);
      $('#trId_' + result.data.id).find("td").eq(1).html(result.data.vendedor);
      $('#trId_' + result.data.id).find("td").eq(2).html(result.data.telefono);
      $('#trId_' + result.data.id).find("td").eq(3).html(result.data.direccion);
     clear();
     auxId='';
		},
		error: function(e) {}
	});
}


//Delete from Table
function deleteFromTable(id){
  auxId=id;
}
function editFromTable(id){
  auxId=id;
  GetById(auxId);
}
//Modal Confirmation when okey
$(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId=''
});
//
$(document).on('click', '#okeyAdd', function (e) {
  SaveData($("#nombre").val(),$("#vendedor").val(),$("#telefono").val(),$("#direccion").val());
    $("#trId_"+auxId).remove();
});
$(document).on('click', '#okeyEdit', function (e) {
  update($("#nombreEdit").val(),$("#vendedorEdit").val(), $("#telefonoEdit").val(),$("#direccionEdit").val());
});
function clear(){
  $("#nombre").val("");
  $("#vendedor").val("");
  $("#telefono").val("");
  $("#direccion").val("");

  $("#nombreEdit").val("");
  $("#vendedorEdit").val("");
  $("#telefonoEdit").val("");
  $("#direccionEdit").val("");
}
</script>

<!-- ADD -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" id="nombre" class="form-control" placeholder="nombre de sistema">
          </div>
          <div class="form-group">
              <label>Vendedor</label>
              <input type="text"id="vendedor" class="form-control" placeholder="Http://www.example.com">
          </div>
          <div class="form-group">
              <label>Telefono</label>
              <input type="text"id="telefono" class="form-control" placeholder="Http://www.example.com">
          </div>
          <div class="form-group">
              <label>Direccion</label>
              <input type="text"id="direccion" class="form-control" placeholder="Http://www.example.com">
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okeyAdd" >Registrar</button>
        </div>
      </div>
    </div>
  </div>
<!-- ADD -->

<!-- EDIT -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" id="nombreEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Vendedor</label>
              <input type="text"id="vendedorEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Telefono</label>
              <input type="text"id="telefonoEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Direccion</label>
              <input type="text"id="direccionEdit" class="form-control" value="">
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okeyEdit" >Actualizar</button>
        </div>
      </div>
    </div>
  </div>
<!-- /EDIT -->

<!-- Confirmation Modal -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmacion</h4>
                </div>
            
                <div class="modal-body">
                    <p>esta seguro de Borrar el registro?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="okey" >Si, estoy seguro</button>
                </div>
            </div>
        </div>
    </div>
<!-- Confirmation Modal -->