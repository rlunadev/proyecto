
@extends('template.main')
@section('title','Fases')
@section('content')
<!-- GANTT -->

<link rel="stylesheet" type="text/css" href="{{asset('gantt/lib/jquery-ui-1.8.4.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('gantt/jquery.ganttView.css')}}" />

<div class="panel panel-default" id="noPrintable">
	<div class="col-md-12" style="background-color:#f5f5f5">
		<div class="col-md-8">
			<div class="panel-heading">Fases</div>
		</div>
		<div class="col-md-4">
        
		</div>
	</div>
		<div>
	  
            <!-- /.box-header -->
          
            <!-- /.box-body -->
          </div>
          <div class="box-body">
          <table id="table1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nombre proyecto</th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
		
</div>
@endsection

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script> 
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{asset('gantt/lib/jquery-1.4.2.js')}}"></script>
<script src="{{asset('gantt/lib/jquery-ui-1.8.4.js')}}"></script>
<script src="{{asset('gantt/lib/date.js')}}"></script>
<script src="{{asset('gantt/example/data.js')}}"></script>
<script src="{{asset('gantt/jquery.ganttView.js')}}"></script>


<script>
function getgant(result){
  $(function () {
    $("#ganttChart").ganttView({ 
      data: result,
      slideWidth: 620,
      behavior: {
        onClick: function (data) { 
         // var msg = "selecciono: { id = "+data.id+",start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
         // $("#eventMessage").text(msg);
        },
        onResize: function (data) { 
          var msg = "fecha movida: { id = "+data.id+", start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
         // $("#eventMessage").text(msg);
          updateDate(data.id, data.start.toString("yyyy-M-d"),data.end.toString("yyyy-M-d"));
        },
        onDrag: function (data) { 
          var msg = "cambio: { id = "+data.id+", start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
          updateDate(data.id, data.start.toString("yyyy-M-d"),data.end.toString("yyyy-M-d"));
         // $("#eventMessage").text(msg);
        }
      }
    });
  });
}
getAll();

//Get all ITEM
  function getAll(){
    $.ajax({
      type: 'POST',
      url:"http://localhost:8000/proyecto/calculo/public/api/proyecto/GetAll?token="+localStorage.getItem('token'),
      success: function(result) {
        $.each(result.data, function() {
          $.each(this, function(index, value) {
            var diferencia=value.presupuesto-value.total;
            var newItem = $("<tr  id='trId_"+value.id+"' role='row' class='odd'><td class='sorting_1'>" + value.nombre + "</td><td></td><td></td><td></td><td></td><td></td><td class='text-right'><button type='button' class='btn btn-default btn-sm'  onclick='editFromTable("+value.id+")' data-href='"+value.id+"'  data-toggle='modal' data-target='#modal-edit' > Ver </button></td></tr>");
              $("#table1 tbody").append(newItem);
          });
        });
        $('#table1').DataTable({});
      },
      error: function(e) {}
    });
  }
  //Update Date
  function updateDate(id,fecha_inicio,fecha_final){
    $.ajax({
      type: 'POST',
      url:"http://localhost:8000/proyecto/calculo/public/api/modulo/UpdateDataById?token="+localStorage.getItem('token'),
      data:{
        id:id,
        fecha_inicio:fecha_inicio,
        fecha_final:fecha_final,
      },
      success: function(result) {
        console.log(result);
      },
      error: function(e) {}
    });
  }
  //Get Modules and project 
  function GetByIdData (id){
    $.ajax({
      type: 'POST',
      url:"http://localhost:8000/proyecto/calculo/public/api/proyecto/GetByIdDate?token="+localStorage.getItem('token'),
      data:{
        id:id
      },
      success: function(result) {
        $("#ganttChart").empty();
        getgant(result);
      },
      error: function(e) {}
    });
  }
  function editFromTable(id){
  auxId=id;
  GetByIdData(auxId);
}
//PRINT
$(document).on('click','#printGantt',function(){
  $("#printable").css("display", "block");
  $("#noPrintable").css("display", "none");
  window.print();
});
</script>

<!-- EDIT -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Proyecto</h4>
        </div>
        <div class="modal-body" id="printable">
            <div id="ganttChart" wit></div>
            <br/><br/>
            <div id="eventMessage"></div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" id="printGantt">Imprimir</button>
        </div>
      </div>
    </div>
  </div>
<!-- /EDIT -->
