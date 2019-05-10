
@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Grupos</div>
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
                  <th>Rol</th>
                  <th>Sistema</th>
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
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->

<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2()
 });
 getAll();
 
 //Get all Users
function getAll(){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/grupos/GetAll?token="+localStorage.getItem('token'),
		success: function(result) {
			$.each(result.data, function() {
				$.each(this, function(index, value) {
            		var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>"+value.empresa.nombre+" </td><td> "+value.rol.nombre+"</td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Edit </button> <button type='button' class='btn btn-default btn-sm'  onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
					$("#table1 tbody").append(newItem);
				});
			});
      $('#table1').DataTable()
		},
		error: function(e) {
     
    }
	});
}
// Delete By Id
function deleteById (id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/grupos/DeleteById?token="+localStorage.getItem('token'),
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
function SaveData (nombre,rol_id,empresa_id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/grupos/SaveData?token="+localStorage.getItem('token'),
    data:{
      nombre:nombre,
      rol_id:rol_id,
      empresa_id:empresa_id
    },
		success: function(result) {
      if(!result.success) {
        for(var key in result.error){
          for(var i = 0;i<result.error[key].length;i++){
            message+=result.error[key]+" <br> ";
          }
        }
      showError(message);
      message='';
      }
      else {
      var newItem = $("<tr  id='trId_"+result.result.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" +result.result.nombre + "</td><td>"+$("#roles :selected").text()+" </td><td> "+$("#empresa :selected").text()+"</td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='editFromTable("+result.result.id+")' data-href='"+result.result.id+"'  data-toggle='modal' data-target='#modal-edit' > Edit </button> <button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+result.result.id+")' data-href='"+result.result.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
					$("#table1 tbody").append(newItem);
          clear();
        }
		},
		error: function(e) {
    }
	});
}
//Get By Id 
function GetById (id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/grupos/GetById?token="+localStorage.getItem('token'),
    data:{
      id:id
    },
		success: function(result) {
      $("#nombreEdit").val(result.data.data[0].nombre);
      $("#rolesEdit").val(result.data.data[0].rol.id);
      $("#sistemaEdit").val(result.data.data[0].empresa.id);

      getSelectOption('roles',1,result.data.data[0].rol.id);
      getSelectOption('empresa',1,result.data.data[0].empresa.id);
		},
		error: function(e) {
    }
	});
}
//Update
function update (nombre,rol_id,empresa_id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/grupos/Update?token="+localStorage.getItem('token'),
    data:{
      id:auxId,
      nombre:nombre,
      rol_id:rol_id,
      empresa_id:empresa_id
    },
		success: function(result) {
      if(!result.success) {
        for(var key in result.error){
          for(var i = 0;i<result.error[key].length;i++){
            message+=result.error[key]+" <br> ";
          }
        }
      showError(message);
      message='';
      }
      else{
        $('#trId_' + result.data.id).find("td").eq(0).html(result.data.nombre);
        $('#trId_' + result.data.id).find("td").eq(1).html($("#roles :selected").text());
        $('#trId_' + result.data.id).find("td").eq(2).html($("#empresa :selected").text());
      clear();
      auxId='';
      }
		},
		error: function(e) {
    }
	});
}
//SELECT OPTION
function getSelectOption(nombreSelect,isEdit,id){
    clearSelect(nombreSelect);
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/"+nombreSelect+"/GetAll?token="+localStorage.getItem('token'),
      success: function(result) {
        if(!isEdit){
          $.each(result.data, function() {
            $.each(this, function(index, value) {
              if(id==value.id)
                {var newItem = $("<option  value='"+value.id+"' selected>"+value.nombre+"</option>");}
              else
                {var newItem = $("<option  value='"+value.id+"'>"+value.nombre+"</option>");}

                $("#"+nombreSelect).append(newItem);
            });
          });
        }
        else {
          $.each(result.data, function() {
            $.each(this, function(index, value) {
              if(id==value.id)
                {var newItem = $("<option  value='"+value.id+"' selected>"+value.nombre+"</option>");}
              else
                {var newItem = $("<option  value='"+value.id+"'>"+value.nombre+"</option>");}

                $("#"+nombreSelect+"Edit").append(newItem);
               // var newItem = $("<option  value='"+value.id+"'>"+value.nombre+"</option>");
               // $("#select_"+nombreSelect+"Edit").append(newItem);
            });
          });
        }
      },
      error: function(e) {}
    }); 
  }

// END SELECT OPTION

getSelectOption('roles',0,0);
getSelectOption('empresa',0,0);


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
  SaveData($("#nombre").val(),$("#roles").val(),$("#empresa").val());
    $("#trId_"+auxId).remove();
});
$(document).on('click', '#okeyEdit', function (e) {
  update($("#nombreEdit").val(),$("#rolesEdit").val(),$("#empresaEdit").val());
});
function clear(){
  $("#nombre").val("");
  $("#roles").val("");
  $("#empresa").val("")
}
function clearSelect(tipo){
  $("#"+tipo+"Edit").find('option').remove();

  $("#"+tipo).find('option').remove();
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
              <label>Rol</label>
              <select class="form-control select2" id="roles" style="width: 100%;">

              </select>
          </div>
          <div class="form-group">
              <label>Empresa</label>
              <select class="form-control select2" id="empresa" style="width: 100%;">

              </select>
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
              <label>Rol</label>
              <select class="form-control select2" id="rolesEdit" style="width: 100%;">

              </select>
          </div>
          <div class="form-group">
              <label>Empresa</label>
              <select class="form-control select2" id="empresaEdit" style="width: 100%;">

              </select>
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