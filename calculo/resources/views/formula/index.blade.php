@extends('template.main')
@section('title','Indice usuario')
@section('content')  
    <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Formulas</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
          <table id="table1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>nombre formula</th>
              <th>Total.</th>
              <th>Fecha </th>
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
      url:{!!json_encode(url('/'))!!}+"/api/formula/GetAll?token="+localStorage.getItem('token'),
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td>" + value.subTotal+" </td><td>" + value.fecha+" </td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Detalle </button></td></tr>");
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
      url:{!!json_encode(url('/'))!!}+"/api/formula/GetById?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
           generateDetails(value.formula_detalle);
           $("#nombreSalida").text(value.nombre);
           $("#empresaSolicitud").text(value.empresa_solicitante);
           $("#fechaSalida").text(value.fecha);
           var newItem = $("<tfoot><tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'></td><td> </td><td> </td><td> <b>TOTAL</b> </td><td><b>" + value.subTotal+"</b></td></tr></tfoot>");
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
      var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.parametro.nombre + "</td><td>"+value.parametro.unidad+"</td><td>" + value.cantidad+" </td><td>" + value.precio+" </td><td>" + value.subTotal+" </td></tr>");
      $("#table2 tbody").append(newItem);
    });
  }

  function editFromTable(id){
  auxId=id;
  $(".detalleTablaFormulaProducto").load("http://localhost:8000/calculo/public/partial/detalleTablaFormulaProducto.html");
  GetById(auxId);ss
}
</script>

<!-- TABLE DETAILS -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalle </h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12" >
            <div class="col-md-4">
            <h5  style="display:inline"><b>Nombre Salida: </b></h5> <p id="nombreSalida" style="display:inline"></p>
            </div>
            <!-- <div class="col-md-4">
            <h5 style="display:inline"><b>Empresa Solicitud: </b></h5> <p id="empresaSolicitud" style="display:inline"></p>
            </div> -->
            <div class="col-md-4">
            <h5 style="display:inline"><b>Fecha Salida: </b></h5><p id="fechaSalida"  style="display:inline"></p>
            </div>
          </div>
          <div class="col-md-12" >
            <br>
          </div>
         <div class="detalleTablaFormulaProducto"></div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okeyEdit" >Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!-- /EDIT -->