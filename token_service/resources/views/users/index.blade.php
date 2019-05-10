@extends('template.main')
@section('title','Indice usuario')
@section('content')
<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading"> <i class="fa fa-spin fa-refresh"></i> Usuarios</div>
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
                  <th>Email</th>
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
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script>
 $(document).ready(function () {
	$('.select2').select2()
 });
 var auxId='';
 getAll();
 //Get all Users
function getAll(){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/users/GetAll?token="+localStorage.getItem('token'),
		success: function(result) {
			$.each(result.data, function() {
				$.each(this, function(index, value) {
          var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.name + "</td><td>" + value.email+" </td><td> </td><td class='text-right'><button type='button' class='btn btn-sm'   onclick='editFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#modal-edit'><i class='glyphicon glyphicon-edit'></i> Edit </button> <button type='button' class='btn btn-sm'  onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'><i class='glyphicon glyphicon-trash'></i> Delete </button></td></tr>");
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
		url:{!!json_encode(url('/'))!!}+"/api/users/DeleteById?token="+localStorage.getItem('token'),
    data:{
      id:id
    },
		success: function(result) {
		  console.log(result);
		},
		error: function(e) {}
	});
}
//Delete from Table
var deleteid='';
function deleteFromTable(id){
deleteid=id
}
// EDIT FROM TABLE
function editFromTable(id){
  auxId=id;
  GetById(auxId);
}
//Modal Confirmation
$(document).on('click', '#okey', function (e) {
       deleteById(deleteid);
       $("#trId_"+deleteid).remove();
       deleteid='';
    });

getSelectOption('grupos',0,0);
// GET Any Select Option
  function getSelectOption(nombreSelect,isEdit,id){
    clearSelect(nombreSelect);
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/"+nombreSelect+"/GetSelect?token="+localStorage.getItem('token'),
      success: function(result) {
        if(!isEdit){
          $.each(result.data, function() {
            $.each(this, function(index, value) {
              if(id==value.id)
                {var newItem = $("<option  value='"+value.id+"' selected>"+value.nombre+"</option>");}
              else
                {var newItem = $("<option  value='"+value.id+"'>"+value.nombre+"</option>");}

                $("#select_"+nombreSelect).append(newItem);
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

                $("#select_"+nombreSelect+"Edit").append(newItem);
              // var newItem = $("<option  value='"+value.id+"'>"+value.nombre+"</option>");
              // $("#select_"+nombreSelect+"Edit").append(newItem);
            });
          });
        }
      },
      error: function(e) {}
    }); 
  }
function clearSelect(tipo){
  $("#select_"+tipo+"Edit").find('option').remove();
  $("#select_"+tipo).find('option').remove();
}
//Get By Id 
function GetById (id){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/users/GetById?token="+localStorage.getItem('token'),
    data:{
      id:id
    },
		success: function(result) {
      $("#nombreEdit").val(result.data.data.name);
      $("#emailEdit").val(result.data.data.email);
		},
		error: function(e) {
    }
	});
}
//Save Data
function SaveData (name,email,password,password_confirmation,select_grupos){
	$.ajax({
		type: 'POST',
		url:{!!json_encode(url('/'))!!}+"/api/register",
    data:{
      name:name,
      email:email,
      password:password,
      password_confirmation:password_confirmation,
      grupo_id:select_grupos

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

      var newItem = $("<tr  id='trId_"+result.result.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" +result.result.nombre + "</td><td>" + result.result.descripcion+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='editFromTable("+result.result.id+")' data-href='"+result.result.id+"'  data-toggle='modal' data-target='#modal-edit' > Edit </button> <button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+result.result.id+")' data-href='"+result.result.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
					$("#table1 tbody").append(newItem);
          clear();

		},
		error: function(e) {}
	});
}

$(document).on('click', '#okeyAdd', function (e) {
  SaveData($("#nombre").val(),$("#email").val(),$("#password").val(),$("#password_verification").val(),$("#select_grupos").val());
  //  $("#trId_"+auxId).remove();
});
</script>

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Editar</h4>
			</div>
			<div class="modal-body">

			<div class="">
            <div class="">
              
            </div>
            <!-- /.box-header -->
            <div class="">
                <!-- text input -->
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombreEdit" placeholder="escriba su nombre">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="emailEdit" placeholder="email@mail.com">
              </div>
              <!-- select -->
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" placeholder="********">
              </div>
              <div class="form-group">
                <label>Verifique Password </label>
                <input type="password" class="form-control" id="password_verification" placeholder="********">
              </div>   

				      <div class="form-group">
                <label>Asignar Sistema</label>
                <select class="form-control select2" id="select_grupos" style="width: 100%;">
                
               </select>
			        </div>
			  
            </div>
            <!-- /.box-body -->
          </div>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
			<button type="button" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Editar</h4>
			</div>
			<div class="modal-body">

      <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" id="nombre" placeholder="escriba su nombre">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" id="email" placeholder="email@mail.com">
				        </div>
                <!-- select -->
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="password" placeholder="********">
                </div>
                <div class="form-group">
                  <label>Verifique Password </label>
                  <input type="password" class="form-control" id="password_verification" placeholder="********">
				        </div>   

				      <div class="form-group">
                <label>Asignar Sistema</label>
                <select class="form-control select2" id="select_grupos" style="width: 100%;">
                
               </select>
			        </div>
            
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
			<button type="button" class="btn btn-primary"  data-dismiss="modal" id="okeyAdd">Guardar</button>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


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
<!-- /.modal -->
