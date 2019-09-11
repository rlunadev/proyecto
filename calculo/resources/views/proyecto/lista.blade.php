@extends('template.main')
@section('title','Indice usuario')
@section('content')  
    <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Proyectos</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
          <table id="table1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre proyecto</th>
              <th>presupuesto</th>
              <th>Total</th>
              <th>Diferencia.</th>
              <th>Fecha Inicio</th>
              <th>Fecha Final</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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
 });
 getAll();

//Get all ITEM
  function getAll(){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/proyecto/GetAll?token="+localStorage.getItem('token'),
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var diferencia=(value.presupuesto-value.total).toFixed(2);
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>" + value.presupuesto+" </td><td>" + value.total+" </td><td>" +diferencia+" </td><td>" + value.fecha_inicio+" </td><td>" + value.fecha_final+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'>Editar</button><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Detalle </button></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
        $('#table1').DataTable({});
      },
      error: function(e) {}
    });
  }
//Get By Id
  function GetById (id){
    $.ajax({
      type: 'POST',
      url:{!!json_encode(url('/'))!!}+"/api/proyecto/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        //console.log($.parseHTML(result));

        $.each(result.data, function() {
          $.each(this, function(index, value) {
           generateDetails(value.modulo);
           $("#nombreSalida").text(value.nombre);
           $("#empresaSolicitud").text(value.empresa_solicitante);
           $("#fechaSalida").text(value.fecha_inicio);
           $("#fechafinal").text(value.fecha_final);
           $("#ubicacion").text(value.ubicacion);
           var newItem = 
           `<tfoot>
           <tr  id='trId_${value.id}' role='row' class='odd'>
           <td class='sorting_1'></td><td></td><td> 
           <b>TOTAL</b> 
           </td><td>
           <b>${value.total}</b>
           </td></tr></tfoot>`;
           $("#table2").append(newItem);
          });
        });
       // $('#table2').DataTable({});
      },
      error: function(e) {}
    });
  }
  function generateDetails(result){
    $.each(result, function(index, value) {
      var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'> <b>Modulo: </b> " + value.nombre + "</td><td></td><td></td><td> </tr>");
      $("#table2 tbody").append(newItem);
      moduloDetalle(value.moduloDetalle);
    });
  }
  function moduloDetalle(result){
     var s = $("<tr  id='' role='row' class='odd'><td class='sorting_1'><b>Nombre formula</b></td><td><b>P. Unit.</b></td><td><b>Cantidad</b></td><td><b> Sub Total</b></tr>");
     $("#table2 tbody").append(s);
    $.each(result, function(index, value) {
      console.log(value.cantidad);
      var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.formula.nombre + "</td><td>"+value.formula.subTotal+"</td><td>"+value.cantidad+"</td><td> "+value.subTotal+"</td></tr>");
      //formula(value.)
      $("#table2 tbody").append(newItem);
    });
  }
  $(document).on('click', '#imprimir', function (e) {
    $('#imprime').show();
    window.print();
  });

  function editFromTable(id){
  auxId=id;
  $(".detalleTablaFormulaProducto").load("http://localhost:8000/proyecto/calculo/public/partial/detalleProyectoModal.html");
  GetById(auxId);
}
</script>

<!-- TABLE DETAILS -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="imprime">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalle </h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12" >
            <div class="col-md-4">
            <h5  style="display:inline"><b>Nombre proyecto: </b></h5> <p id="nombreSalida" style="display:inline"></p>
            </div>
            <!-- <div class="col-md-4">
            <h5 style="display:inline"><b>Empresa Solicitud: </b></h5> <p id="empresaSolicitud" style="display:inline"></p>
            </div> -->
            <div class="col-md-2">
            <h5 style="display:inline"><b>Fecha inicio: </b></h5><p id="fechaSalida"  style="display:inline"></p>
            </div>
            <div class="col-md-2">
            <h5 style="display:inline"><b>Fecha final: </b></h5><p id="fechafinal"  style="display:inline"></p>
            </div>
            <div class="col-md-4">
            <h5 style="display:inline"><b>Ubicacion: </b></h5><p id="ubicacion"  style="display:inline"></p>
            </div>
          </div>
          <div class="col-md-12" >
            <br>
          </div>
         <div class="detalleTablaFormulaProducto"></div>
        </div>
        <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" id="imprimir" >Imprimir</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okeyEdit" >Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!-- /EDIT -->