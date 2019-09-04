
@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
		<div>
      <div class="col-md-5">
        <div class="row">
          <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Parametros</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
              <div class="box-body">
                  <div class='tableSalida'></div>
               
              </div>
            </div>
          </div>
        </div>
    <div class="col-md-7">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Productos disponibles</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
          <table id="table1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio </th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
      </div>
</div>
@endsection

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->

<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2();
  $(".tableSalida").load("http://localhost:8000/proyecto/calculo/public/partial/parametros.html");
  });
 getAll();
//Get all ITEM
  function getAll(){
    $.ajax({
      type: 'POST',
      url:"http://localhost:8000/proyecto/inventario/public/api/item/GetAll?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        console.log(result);
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>" + value.cantidad+" </td><td>" + value.precio_venta+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Agregar </button></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
        $('#table1').DataTable({
        });
        getAllDetalle(); 
      },
      error: function(e) {
        alert("Servicio de Inventario no Disponible!!!");
        getAllDetalle();
       }
    });
  }
//Get all Parameters WHERE STATUS=1
  function getAllDetalle(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/parametro/GetAll?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.nombre + "</td><td >" + value.precio_venta+" </td><td> </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Borrar </button></td></tr>");
              $("#table2 tbody").append(newItem);
          });
        });
        $('#table2').DataTable({});
        sumaTotal();
      },
      error: function(e) {}
    });
  }
//Delete By Id
  function deleteById (id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/parametro/DeleteById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        //console.log(result);
        updateTablaCantidadItem (result.item_id);
        sumaTotal();
      },
      error: function(e) {}
    });
  }
//SAVE DETALLE SALIDA DETALLE
  function SaveData (nombre,precio_venta,unidad_id,unidad_formula,nombre_empresa,empresa_id,equivale,categoria,unidad){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/parametro/SaveData?token="+localStorage.getItem('token'),
      data:{
        item_id:auxId,
        nombre:nombre,
        precio_venta:precio_venta,
        unidad_id:unidad_id,
        unidad_formula:unidad_formula,
        nombre_empresa:nombre_empresa,
        empresa_id:empresa_id,
        equivale:equivale,
        categoria:categoria,
        unidad:unidad
      },
      success: function(obj) {
        updateTablaCantidadItem (obj.id);
        $(".tableSalida").load("http://localhost:8000/proyecto/calculo/public/partial/parametros.html");
        getAllDetalle();
        clear();
        auxId='';
        sumaTotal();
      },
      error: function(e) {}
    });
  }
//Get By Id
  function GetById (id){
    $.ajax({
      type: 'POST',
      url:"http://localhost:8000/proyecto/inventario/public/api/item/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $("#nombre").val(result.data.data[0].nombre);
        $("#precio_venta").val(result.data.data[0].precio_venta);
        $("#unidad_id").val(result.data.data[0].unidad.id);
        $("#unidad_formula").val(result.data.data[0].unidad.valor);
        $("#equivale").val(result.data.data[0].equivale);
        $("#categoria").val(result.data.data[0].categoria.nombre);
        $("#unidad").val(result.data.data[0].unidad.nombre);
      },
      error: function(e) {}
    });
  }
//Update ITEM cantidad
 function updateTablaCantidadItem (item_id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/parametro/GetById?token="+localStorage.getItem('token'),
      data:{
        id:item_id
      },
      success: function(result) {
      auxId='';
      },
      error: function(e) {}
    });
 }
 function SaveSalida (){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/salida/SaveData?token="+localStorage.getItem('token'),
      data:{
        nombre:$("#nombre").val(),
        empresa_solicitante:$("#empresa_solicitante").val()
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
        if(result.success){
          window.location.href ="http://localhost:8000/proyecto/inventario/public/salidaLista?token="+localStorage.getItem('token')
        }
      }

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

$(document).on('click', '#closeSalida', function (e) {
  SaveSalida();
});
  $(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId='';
  });

  $(document).on('click', '#okeyEdit', function (e) {
    SaveData($("#nombre").val(),$("#precio_venta").val(),$("#unidad_id").val(),$("#unidad_formula").val(),$("#nombre_empresa").val(),$("#empresa_id").val(),$("#equivale").val(),$("#categoria").val(),$("#unidad").val());
  });
function clear(){
  //clear all input and delete values
  $("#modal-edit").find('input').val('');
  $("#modal-add").find('input').val('');
}
function clearSelect(tipo){
  $("#select_"+tipo+"Edit").find('option').remove();
  $("#select_"+tipo).find('option').remove();
}
function sumaTotal(){
var sum=0;
$(".precio").each(function(){
  var value=$(this).text();
    if(!isNaN(value) && value.legth!=0){
      sum+=parseFloat(value);
    }
  });
  $("#total").text(sum);
}
</script>

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
            <input type="text" id="nombre" class="form-control" value="" disabled="true">
          </div>
          <!-- <div class="form-group">
            <label>Cantidad</label> -->
            <input type="hidden" id="cantidad" value="1" class="form-control" value="" required>
            <input type="hidden" id="precio_venta" class="form-control" value="" required>
            <input type="hidden" id="unidad_id" class="form-control" value="" required>
            <input type="hidden" id="unidad_formula" class="form-control" value="" required>
            <input type="hidden" id="nombre_empresa" class="form-control" value="" required>
            <input type="hidden" id="empresa_id" class="form-control" value="" required>
            <input type="hidden" id="equivale" class="form-control" value="" required>
            <input type="hidden" id="categoria" class="form-control" value="" required>
            <input type="hidden" id="unidad" class="form-control" value="" required>
          <!-- </div> -->
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okeyEdit" >Agregar</button>
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