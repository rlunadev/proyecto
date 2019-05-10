
@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Usuarios</div>
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
                  <th></th>
                </tr>
                </thead>
                <tbody>
					          <tr><td><td><td></td></td></td></tr>
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
 $(document).ready(function () {
	$('.select2').select2()
 });
 getAll();
 //Get all Users
function getAll(){
	$.ajax({
		type: 'GET',
		url:{!!json_encode(url('/'))!!}+"/api/users/GetAll?token="+localStorage.getItem('token'),
		success: function(result) {
			$.each(result.data, function() {
				$.each(this, function(index, value) {
					//var newItem = $("<tr role='row' class='odd'><td class='sorting_1'>"+index + "</td><td> " + value.name + "</td><td>" + value.email+"</td><td></td><td></td></tr>");
            		var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.name + "</td><td>" + value.email+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  data-toggle='modal' data-target='#modal-edit'> Edit </button> <button type='button' class='btn btn-default btn-sm'  onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Delete </button></td></tr>");
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
//Modal Confirmation
$(document).on('click', '#okey', function (e) {
       deleteById(deleteid);
       $("#trId_"+deleteid).remove();
       deleteid=''
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
              <form role="">
                <!-- text input -->
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="escriba su nombre">
				</div>
				<div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="email@mail.com">
				</div>
                <!-- select -->
                <div class="form-group">
                  <label>Rol</label>
                  <select class="form-control">
                    <option>Super Admin</option>
                    <option>Admin</option>
                    <option>User</option>
                  </select>
                </div>

				<div class="form-group">
                <label>Sistemas</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione"
                        style="width: 100%;">
                  <option>Inventarios</option>
                  <option>Calculo</option>
                  <option>Usuarios</option>
                  <option>Pagos</option>
                  <option>Seguimiento</option>
                </select>
			  </div>
			  <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Activo
                    </label>
                  </div>               
                </div>
			  </form>
			  
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

			<div class="">
            <div class="">
              
            </div>
            <!-- /.box-header -->
            <div class="">
              <form role="">
                <!-- text input -->
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="escriba su nombre">
				</div>
				<div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="email@mail.com">
				</div>
                <!-- select -->
                <div class="form-group">
                  <label>Rol</label>
                  <select class="form-control">
                    <option>Super Admin</option>
                    <option>Admin</option>
                    <option>User</option>
                  </select>
                </div>

				<div class="form-group">
                <label>Sistemas</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione"
                        style="width: 100%;">
                  <option>Inventarios</option>
                  <option>Calculo</option>
                  <option>Usuarios</option>
                  <option>Pagos</option>
                  <option>Seguimiento</option>
                </select>
			  </div>
			  <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Activo
                    </label>
                  </div>               
                </div>
			  </form>
			  
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
