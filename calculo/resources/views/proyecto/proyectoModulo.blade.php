@extends('template.main')
@section('title','Indice usuario')
@section('content')

<div class="panel panel-default">
		<div>
      <input type="hidden" id="proyectoId">
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
                      <button type="button" class="btn btn-primary pull-right" id="crearProyecto"> Crear</button>
                    </div>
                  <br><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Modulos de proyecto</h3>
        
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body">
                  <table id="table3" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Subtotal</th>
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
        </div>
       
    <div class="col-md-6" id="modulosdisp" style="pointer-events: none; opacity: 0.4;">
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
              <th></th>
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
  $(".tableSalida").load("http://localhost:8000/calculo/public/partial/test.html");
  $('.datepicker').datepicker({autoclose: true})
 });
 getAll();
var subtotal=0
//CREATE PROYECTO FROM MODULES
  function getAll(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/modulo/GetAllGroup?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        console.log(result.data);
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = `
            <tr  id='trId_"${value.id}' role='row' class='odd'>
            <td class='sorting_1'>${value.nombre}</td>
              <td>  </td>
            <td class='subtotal'>${value.subTotal/value.cantidad} </td>
              <td class='text-right'><button class="btn btn-default" onclick="agregarModulo('${value.modulo_id}','${value.nombre}')" data-toggle='modal' data-target='#modal-edit' onclick="abrirModulo(${value.subtotal})"> Agregar</button></td>
            </tr>")`;
              $("#table1 tbody").append(newItem);
              subtotal =value.subTotal/value.cantidad;
          });
        });
        var newItem = $("<tfoot><tr><td></td><td><b>TOTAL</b></td><td><p id='total'></p> </td><td></td></tr></tfoot>");
        $("#table1").append(newItem);
        sumaTotal();
        $('#table1').DataTable({
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
            var newItem = `<tr  
            id='trId_"${value.id}' role='row' class='odd'>
            <td class='sorting_1'> <input type='hidden'> ${value.nombre_producto} </td>
            <td>" ${value.cantidad} </td>
            <td > ${value.precio_venta} </td>
            <td class='precio'>${value.subTotal} </td>
            <td class='text-right'>
            <button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable(${value.id})' data-href='${value.id}' data-toggle='modal' data-target='#confirm-modal'> Borrar </button>
            </td>
            </tr>")`;
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
        updateTablaCantidadItem (result.item_id);
        sumaTotal();
      },
      error: function(e) {}
    });
  }
//SAVE DETALLE SALIDA DETALLE
  function guardarModulo(){
    //$("#modal-edit").modal('toggle');
   var cantidad = $("#cantidadEdit").val();
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/proyecto/CreaProyectoModulo?token="+localStorage.getItem('token'),
      data:{
        proyectoId: $("#proyectoId").val(),
        fecha_inicio: $("#fecha_inicio").val(),
        fecha_final: $("#fecha_final").val(),
        moduloId: moduloId,
        cantidad: cantidad,
        subtotal: subtotal,
      },
      success: function(obj) {
       var item = `<tr>
                      <td>${nombreModulo}</td>
                      <td>${cantidad}</td>
                      <td>${subtotal}</td>
                    </tr>`;

       $("#table3 tbody").append(item);
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
 function registrarProyecto (){
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
        console.log(result.data);
        $("#modulosdisp").css({"pointer-events": "","opacity":"1" });
        $("#proyectoId").val(result.data.id);
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
          //location.reload();
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
$(document).on('click', '#crearProyecto', function (e) {
  registrarProyecto();
});

  $(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId='';
  });
  var moduloId ='';
  var nombreModulo = '';
  function agregarModulo(id, nModulo){
    moduloId = id;
    nombreModulo = nModulo;
    $("#cantidadEdit").val('');
    console.log(moduloId);
  }
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
$(".subtotal").each(function(){
  var value=$(this).text();
    if(!isNaN(value) && value.legth!=0){
      sum+=parseFloat(value);
    }
  });
  $("#total").text(sum.toFixed(2));
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
            <label>Cantidad</label>
            <input type="number" id="cantidadEdit" class="form-control" value="" required>
          </div>
          
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" >Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="guardarModulo()" >Agregar</button>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="okey" onclick="borrarModulo()">Si, estoy seguro</button>
                </div>
            </div>
        </div>
    </div>
<!-- Confirmation Modal -->