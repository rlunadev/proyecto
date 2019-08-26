
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
                <h3 class="box-title">Datos Modulo</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">

                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombreFormula">Nombre Modulo</label>
                      <input type="text" class="form-control" id="nombreFormula" placeholder="">
                      <input type="hidden" class="form-control" id="idFormula" placeholder="">
                    </div>
                    <!-- <div class="form-group">
                    <label for="nombre">Fecha</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker">
                    </div>
                  </div> -->
                    <div class="form-group">
                    <button type="button" class="btn btn-primary pull-right" id="crearFormula"> Crear</button>
                    </div>

                  </div>

              </div>
            </div>
        </div>
        <div class="row">
          <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Detalle Modulo</h3>
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
        <!-- <div class="panel-footer" >
            <div class="col-md-6">

            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-primary" data-toggle='modal' data-target='#modal-add'> <span class="glyphicon glyphicon-plus"></span>Agregar</button>
            </div>
          <br><br>
        </div> -->
        <input type="hidden" id="equivale" class="form-control" value="">
        <input type="hidden" id="precio" class="form-control" value="">

    <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Formula Disponibles</h3>

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
              <th>P. Unit. </th>
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
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
var auxId='';
 $(document).ready(function () {
	$('.select2').select2();
  $(".tableSalida").load("http://localhost:8000/proyecto/calculo/public/partial/detalleModulo.html");
  $('#datepicker').datepicker({autoclose: true})
  $("#cantidad").keyup(function(){
    var price_sale=parseFloat($("#precio").val());

    console.log($(this).val(),price_sale);
    $("#parcial").text(($(this).val()*(price_sale)).toFixed(2));
  });
 });

 getAll();
 getAllDetalle();
//Get all parameters
  function getAll(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/formula/GetAll?token="+localStorage.getItem('token'),
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>" + value.subTotal+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Agregar </button></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
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
      url:{!!json_encode(url('/'))!!}+"/api/moduloDetalle/GetAll?token="+localStorage.getItem('token'),
      //data:{data:2},
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <input type='hidden'>" + value.formula.nombre + "</td><td>" + value.cantidad + "</td><td>" + value.formula.subTotal + "</td><td class='subTotal'>" + value.subTotal+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm' onclick='deleteFromTable("+value.id+")' data-href='"+value.id+"' data-toggle='modal' data-target='#confirm-modal'> Borrar </button></td></tr>");
              $("#tableDetalleFormula tbody").append(newItem);
          });
        });
        var newItem = $("<tfoot><tr><td></td><td></td><td><b>TOTAL</b></td><td><p id='total'></p> </td><td></td></tr></tfoot>");
        $("#tableDetalleFormula").append(newItem);
        $('#tableDetalleFormula').DataTable({});
          sumaTotal();
      },
      error: function(e) {}
    });
  }
//Delete By Id
  function deleteById (id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/moduloDetalle/DeleteById?token="+localStorage.getItem('token'),
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
  function SaveData (cantidad,subtotal){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/moduloDetalle/SaveData?token="+localStorage.getItem('token'),
      data:{
        formula_id:$("#idFormula").val(),
        cantidad:cantidad,
        subTotal: $("#parcial").text()
      },
      success: function(obj) {
        updateTablaCantidadItem (auxId);
        $(".tableSalida").load("http://localhost:8000/proyecto/calculo/public/partial/detalleModulo.html");
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
      url:{!!json_encode(url('/'))!!}+"/api/formula/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $("#idFormula").val(result.data.data[0].id);
        $("#nombre").val(result.data.data[0].nombre);
        $("#precio").val(result.data.data[0].subTotal);
        //$("#unidad").val(result.data.data[0].unidad);
        // $("#categoria").val(result.data.data[0].categoria);
        // $("#equivale").val(result.data.data[0].equivale);
      },
      error: function(e) {}
    });
  }
//Update ITEM cantidad
 function updateTablaCantidadItem (item_id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/moduloDetalle/GetAll?token="+localStorage.getItem('token'),
      data:{
        id:item_id
      },
      success: function(result) {
        //$('#table1').find('#trId_' + item_id).find("td").eq(1).html(result.data.data[0].cantidad);
        clear();
      auxId='';
      },
      error: function(e) {}
    });
 }
 //save Formula
var idFormula='';
 function Saveformula (){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/modulo/SaveData?token="+localStorage.getItem('token'),
      data:{
        nombre:$("#nombreFormula").val(),
        fecha:$("#datepicker").val(),
        subTotal:$("#total").text()
      },
      success: function(result) {

        //save
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
          idFormula=result.data.id;
          location.reload();
          //$('#crearFormula').attr('disabled','disabled');
         // window.location.href ="http://localhost:8000/proyecto/inventario/public/salidaLista?token="+localStorage.getItem('token')
        }
      }

      },
      error: function(e) {}
    });
  }
// GET Any Select Option//new=0, isedit=1
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
  getSelectOption('categoria',0,0);
//Delete from Table
function deleteFromTable(id){
  auxId=id;
}
function editFromTable(id){
  auxId=id;
  clearText();
  GetById(auxId);
}
function clearText(){
  $("#cantidad").val();
  $("#nombre").val();
  $("#precio").val();
  $("#unidad").val();
  //$("#categoria").val();
  $("#equivale").val();
}
$(document).on('click', '#crearFormula', function (e) {
  Saveformula();
});
  $(document).on('click', '#okey', function (e) {
    deleteById(auxId);
    $("#trId_"+auxId).remove();
    auxId='';
  });
  //
  $(document).on('click', '#okeyEdit', function (e) {
    SaveData($("#cantidad").val(),$("#parcial").text());
  });
function clear(){
  //clear all input and delete values
  $("#modal-edit").find('input').val('');
  $("#modal-add").find('input').val('');
}
function clearSelect(tipo){
}
function sumaTotal(){
var sum=0;
$(".subTotal").each(function(){
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
          <div class="form-group">
            <label>Cantidad</label>
            <input type="number" step="0.001" id="cantidad" class="form-control" value="" >
          </div>
          <div class="form-group">
            <!-- <div class="col-md-6">
              <label>Categoria</label>
              <input type="text" id="categoria" class="form-control" value="" disabled="true">
              <select class="form-control select2" id="select_categoria" style="width: 100%;">

              </select>
            </div> -->
            <!-- <div class="col-md-6">
              <label>Unidad</label>
              <input type="text" id="unidad" class="form-control" value="" disabled="true">
            </div> -->
          </div>

          <div class="form-group">
            <label>Precio parcial:</label>
            <br />
            <label id="parcial"></label>
          </div>
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