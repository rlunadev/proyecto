
@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Productos</div>
		</div>
		<div class="col-md-4">
        
		</div>
	</div>
		<div>
		
	    <div class="">
            </div>
            <!-- /.box-header -->
            <div class="">
              <table id="table1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Equivale </th>
                  <th>P. Venta </th>
                  <th>Unidad</th>
                  <th>Categoria</th>
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
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->

<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2()
 });
 getAll();
 
//Get all
  function getAll(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/GetByEmpresaId?token="+localStorage.getItem('token'),
      data:{data:2},
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
              var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.nombre + "</td><td>" + value.cantidad+" </td><td>" + value.equivale+" </td><td>" + value.precio_venta+" </td><td>" + value.unidad.nombre+" </td><td>" + value.categoria.nombre+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Editar </button> <button type='button' class='btn btn-default btn-sm'  onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Borrar </button></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
        $('#table1').DataTable();
      },
      error: function(e) {}
    });
  }
//Delete By Id
  function deleteById (id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/DeleteById?token="+localStorage.getItem('token'),
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
  function SaveData (nombre,cantidad,equivale,precio_venta,unidad_id,categoria_id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/SaveData?token="+localStorage.getItem('token'),
      data:{
        nombre:nombre,
        cantidad:cantidad,
        equivale:equivale,
        precio_venta:precio_venta,
        unidad_id:unidad_id,
        categoria_id:categoria_id
      },
      success: function(result) {
        var newItem = $("<tr  id='trId_"+result.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" +nombre + "</td><td>" + cantidad+" </td><td>" + equivale+" </td><td>" + precio_venta+" </td><td>" + $("#select_unidad :selected").text()+" </td><td>" + $("#select_categoria :selected").text()+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='editFromTable("+result.id+")' data-href='"+result.id+"'  data-toggle='modal' data-target='#modal-edit' > Editar </button> <button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+result.id+")' data-href='"+result.id+"' data-toggle='modal' data-target='#confirm-modal'> Borrar </button></td></tr>");
            $("#table1 tbody").append(newItem);
            clear();
            clearSelect();
      },
      error: function(e) {}
    });
  }
//Get By Id 
  function GetById (id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $("#nombreEdit").val(result.data.data[0].nombre);
        $("#cantidadEdit").val(result.data.data[0].cantidad);
        $("#equivaleEdit").val(result.data.data[0].equivale);
        $("#precio_ventaEdit").val(result.data.data[0].precio_venta);
        $("#unidadEdit").val(result.data.data[0].unidad.id);
        $("#categoriaEdit").val(result.data.data[0].categoria.id);
        //set select option
        getSelectOption('categoria',1,result.data.data[0].categoria.id);
        getSelectOption('unidad',1,result.data.data[0].unidad.id);

      },
      error: function(e) {}
    });
  }
//Update
 function update (nombre,cantidad,equivale,precio_venta,unidad_id,categoria_id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/Update?token="+localStorage.getItem('token'),
      data:{
        id:auxId,
        nombre:nombre,
        cantidad:cantidad,
        equivale:equivale,
        precio_venta:precio_venta,
        unidad_id:unidad_id,
        categoria_id:categoria_id
      },
      success: function(result) {
        console.log(auxId);
        $('#trId_' + auxId).find("td").eq(0).html(result.data[0].nombre);
        $('#trId_' + auxId).find("td").eq(1).html(result.data[0].cantidad);
        $('#trId_' + auxId).find("td").eq(2).html(result.data[0].equivale);
        $('#trId_' + auxId).find("td").eq(3).html(result.data[0].precio_venta);
        //select option
        $('#trId_' + auxId).find("td").eq(4).html(result.data[0].unidad.nombre);
        $('#trId_' + auxId).find("td").eq(5).html(result.data[0].categoria.nombre);
        clear();
      auxId='';
      },
      error: function(e) {}
    });
 }
// GET Any Select Option
  function getSelectOption(nombreSelect,isEdit,id){
    clearSelect(nombreSelect);
    $.ajax({
      type: 'GET',
      url:{!!json_encode(url('/'))!!}+"/api/"+nombreSelect+"/GetAll?token="+localStorage.getItem('token'),
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

//Delete from Table
function deleteFromTable(id){
  auxId=id;
}
function editFromTable(id){
  auxId=id;
  GetById(auxId);
}
//add=0, isedit=1
getSelectOption('categoria',0,0);
getSelectOption('unidad',0,0);
//Modal Confirmation when okey
  $(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId=''
  });
//
  $(document).on('click', '#okeyAdd', function (e) {
      SaveData($("#nombre").val(),$("#cantidad").val(),$("#equivale").val(),$("#precio_venta").val(),$("#select_unidad").val(),$("#select_categoria").val());
      //$("#trId_"+auxId).remove();
  });
  $(document).on('click', '#okeyEdit', function (e) {
    update($("#nombreEdit").val(),$("#cantidadEdit").val(), $("#equivaleEdit").val(),$("#precio_ventaEdit").val(),$("#select_unidadEdit").val(), $("#select_categoriaEdit").val());
  });
function clear(){
  //clear all input and delete values
  $("#modal-edit").find('input').val('');
  $("#modal-add").find('input').val('');  
}
function clearSelect(tipo){
  $("#select_"+tipo+"Edit").find('option').remove();
  //$("#select_categoriaEdit").find('option').remove();

  $("#select_"+tipo).find('option').remove();
  //$("#select_categoria").find('option').remove();
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
            <input type="text" id="nombre" class="form-control" placeholder="">
          </div>
          <div class="form-group">
              <label>Cantidad</label>
              <input type="number"id="cantidad" class="form-control" placeholder="">
          </div>
          <div class="form-group">
              <label>Equivale</label>
              <input type="number" step="0.1" id="equivale" class="form-control" placeholder="">
          </div>
          <div class="form-group">
              <label>Precio Venta</label>
              <input type="number" step="0.1" id="precio_venta" class="form-control" placeholder="">
          </div>
          <div class="form-group">
              <label>Unidad</label>
              <select class="form-control select2" id="select_unidad" style="width: 100%;">

              </select>
          </div>
          <div class="form-group">
              <label>Categoria</label>
              <select class="form-control select2" id="select_categoria" style="width: 100%;">
               
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
              <label>Cantidad</label>
              <input type="number" id="cantidadEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Equivale</label>
              <input type="number" step="0.1" id="equivaleEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Precio Venta</label>
              <input type="number" step="0.1" id="precio_ventaEdit" class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Unidad</label>
              <input type="hidden" id="unidadEdit" class="form-control" value="">
              <select class="form-control select2" id="select_unidadEdit" style="width: 100%;">

              </select>
          </div>
          <div class="form-group">
              <label>Categoria</label>
              <input type="hidden" id="categoriaEdit" class="form-control" value="">
              <select class="form-control select2" id="select_categoriaEdit" style="width: 100%;">
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