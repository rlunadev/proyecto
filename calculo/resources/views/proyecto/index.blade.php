@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
	<!-- <div class="col-md-12">
		<div class="col-md-8">
			<p class="panel-heading">Salidas</p>
		</div>
		<div class="col-md-4">
		</div>
	</div> -->
		<div>
      
      <!-- /.box-body -->
      <!-- /.box-header -->
      <div class="col-md-6">
        <div class="row">
           <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Datos Proyecto</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre">Nombre Proyecto</label>
                      <input type="text" class="form-control" id="nombre" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="nombre">Ubicacion</label>
                      <input type="text" class="form-control" id="ubicacion" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="nombre">Presupuesto</label>
                      <input type="number" class="form-control" id="presupuesto" placeholder="">
                    </div>
                    <div class="form-group">
                    <label for="nombre">Fecha Inicial</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" class="form-control pull-right" id="fecha_inicio">
                        </div>                    
                    </div>
                    <div class="form-group">
                    <label for="nombre">Fecha Final</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" class="form-control pull-right" id="fecha_final">
                        </div>
                    </div>
                  </div>
              </div>
              <div class="panel-footer" >
                  <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-left">
                      <button type="button" class="btn btn-primary pull-right" id="closeSalida"> Crear</button>
                    </div>
                  <br><br>
                </div>
            </div>
        </div>
        <div class="row">

          </div>
        </div>
       
    <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Modulos Disponibles</h3>

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
              <th>Cant. Disp.</th>
              <th>P. Venta </th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <!-- total<span id="total"></span> -->
          </div>
        </div>
      </div>
</div>
<a href=""class="btn btn-danger" id="siguiente">Crear Proyecto por Módulos</a>
<script>
  $("#siguiente").hover(function(){
     var url=window.location.origin+"/proyecto/calculo/public/proyectoModulo?token="+localStorage.getItem('token');
     $(this).attr('href',url);
  });
</script>
@endsection

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->

<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2();
  $(".tableSalida").load("http://localhost:8000/proyecto/calculo/public/partial/test.html");
  $('.datepicker').datepicker({autoclose: true})
 });
 getAll();
 //getAllDetalle();
//Get all ITEM
  function getAll(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/modulo/GetAll?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>" + value.cantidad+" </td><td class='subtotal'>" + value.subTotal+" </td><td class='text-right'></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
        var newItem = $("<tfoot><tr><td></td><td><b>TOTAL</b></td><td><p id='total'></p> </td><td></td></tr></tfoot>");
        $("#table1").append(newItem);
        sumaTotal();
        $('#table1').DataTable({
          //"pageLength":5
          //"columns":[{"data":"P.Subtotal",render:$.fn.dataTable.render(',','.',2,'')}]
        });
      },
      error: function(e) {}
    });
  }
//Get all DETALLE SALIDA WHERE STATUS=1
  function getAllDetalle(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/Detalle/GetByEmpresaId?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.nombre_producto + "</td><td>" + value.cantidad+" </td><td >" + value.precio_venta+" </td><td class='precio'>" + value.subTotal+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Borrar </button></td></tr>");
              $("#table2 tbody").append(newItem);
          });
        });
        var newItem = $("<tfoot><tr><td></td><td></td><td><b>TOTAL</b></td><td><p id='total'></p> </td><td></td></tr></tfoot>");
        $("#table2").append(newItem);
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
      url:{!!json_encode(url('/'))!!}+"/api/proyecto/DeleteById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        console.log(result);
        updateTablaCantidadItem (result.item_id);
        sumaTotal();
      },
      error: function(e) {}
    });
  }
//SAVE DETALLE SALIDA DETALLE
  function SaveData (nombre,cantidad){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/salidaDetalle/SaveData?token="+localStorage.getItem('token'),
      data:{
        item_id:auxId,
        nombre_producto:nombre,
        cantidad:cantidad,
      },
      success: function(obj) {
        updateTablaCantidadItem (auxId);
        $(".tableSalida").load("http://localhost:8000/inventario/public/partial/test.html");
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
      url:{!!json_encode(url('/'))!!}+"/api/item/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $("#nombreEdit").val(result.data.data[0].nombre);
        $("#precio_ventaEdit").val(result.data.data[0].precio_venta);
      },
      error: function(e) {}
    });
  }
//Update ITEM cantidad
 function updateTablaCantidadItem (item_id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/item/GetById?token="+localStorage.getItem('token'),
      data:{
        id:item_id
      },
      success: function(result) {
        $('#table1').find('#trId_' + item_id).find("td").eq(1).html(result.data.data[0].cantidad);
        clear();
      auxId='';
      },
      error: function(e) {}
    });
 }
 function SaveSalida (){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/proyecto/SaveData?token="+localStorage.getItem('token'),
      data:{
        nombre:$("#nombre").val(),
        ubicacion:$("#ubicacion").val(),
        total:$("#total").text(),
        presupuesto:$("#presupuesto").val(),
        fecha_inicio:$("#fecha_inicio").val(),
        fecha_final:$("#fecha_final").val(),
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
          location.reload();
          //window.location.href ="http://localhost:8000/calculo/public/proyecto?token="+localStorage.getItem('token')
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
$(document).on('click', '#closeSalida', function (e) {
  SaveSalida();
});
//add=0, isedit=1
//getSelectOption('categoria',0,0);
//getSelectOption('unidad',0,0);
//Modal Confirmation when okey
  $(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId='';
  });
//
  // $(document).on('click', '#okeyAdd', function (e) {
  //     SaveData($("#nombre").val(),$("#cantidad").val(),$("#precio_unitario").val(),$("#precio_venta").val(),$("#select_unidad").val(),$("#select_categoria").val());
  //     //$("#trId_"+auxId).remove();
  // });
  $(document).on('click', '#okeyEdit', function (e) {
    SaveData($("#nombreEdit").val(),$("#cantidadEdit").val());
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
function sumaTotal(){
var sum=0;
$(".subtotal").each(function(){
  var value=$(this).text();
    if(!isNaN(value) && value.legth!=0){
      sum+=parseFloat(value);
    }
  });
  $("#total").text(sum);
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
            
          </div>
          <div class="form-group">
              <label>Cantidad</label>
              <input type="number"id="cantidad" class="form-control" placeholder="">
          </div>
          <!-- <div class="form-group">
              <label>Precio Unitario</label>
              <input type="number" step="0.1" id="precio_unitario" class="form-control" placeholder="">
          </div> -->
          <div class="form-group">
              <label>Precio </label>
              <input type="number" step="0.1" id="precio_venta" class="form-control" placeholder="">
          </div>
          <div class="form-group">
              <label>Unidad</label>
              <select class="form-control select2" id="select_unidad" style="width: 100%;" disabled="true">

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
            <input type="text" id="nombreEdit" class="form-control" value="" disabled="true">
          </div>
          <div class="form-group">
            <label>Cantidad</label>
            <input type="number" id="cantidadEdit" class="form-control" value="" required>
          </div>
          <!-- <div class="form-group">
            <label>Nombre de Empresa</label>
            <input type="text" id="nombreEmpresaEdit" class="form-control" value="">
          </div> -->
          <!-- <div class="form-group">
              <label>Precio Unitario</label>
              <input type="number" step="0.1" id="precio_unitarioEdit" class="form-control" value="" disabled="true">
          </div>
          <div class="form-group">
              <label>Precio Venta</label>
              <input type="number" step="0.1" id="precio_ventaEdit" class="form-control" value="" disabled="true">
          </div>
          <div class="form-group">
              <label>Unidad</label>
              <input type="hidden" id="unidadEdit" class="form-control" value="">
              <select class="form-control select2" id="select_unidadEdit" style="width: 100%;" disabled="true">
              </select>
          </div>
          <div class="form-group">
              <label>Categoria</label>
              <input type="hidden" id="categoriaEdit" class="form-control" value="">
              <select class="form-control select2" id="select_categoriaEdit" style="width: 100%;" disabled="true">
              </select>
          </div> -->
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