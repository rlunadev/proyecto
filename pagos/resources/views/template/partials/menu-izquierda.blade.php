<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <br>
        </div>
        <div class="pull-left info">
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree" id="menuIzquierda">
      <!-- roles -->
      <div  class="sidebar-menu" data-widget="tree"  id="roles" style="display:none"> <!-- style="display:none"  -->
        <li>
          <a href="" value="tipoPago">
            <i class="fa fa-laptop"></i> <span>Tipo Pago</span>
          </a>
        </li> 
        <li>
          <a href="" value="tipoEmpleado">
            <i class="fa fa-laptop"></i> <span>Tipo Empleado</span>
          </a>
        </li> 
        <li>
          <a href="" value="empleado">
            <i class="fa fa-laptop"></i> <span>Empleado</span>
          </a>
        </li> 
        <li>
          <a href="" value="pago">
            <i class="fa fa-laptop"></i> <span>Pagos</span>
          </a>
        </li> 
      </div>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
  $("#menuIzquierda li a").hover(function(){
     var url=window.location.origin+"/pagos/public/"+$(this).attr('value')+"?token="+localStorage.getItem('token');
     $(this).attr('href',url);
    });

    setMenu ();
    
    function setMenu (){
      $.ajax({
        type: 'POST',
        url:{!!json_encode(url('/'))!!}+"/api/setMenu?token="+localStorage.getItem('token'),
        data:{},
        success: function(result) {
          if(result.data!=null){
            if(result.data!=null){
              $.each(result.data, function(index, value) {
                if(value.rol=="admin" && value.sistema=="PAGOS"){
                  $("#roles").show();
                }  
              });
            }
          }
          
         $("#usuarioSistema").html("Hola, "+result.user);
        },
        error: function(e) {}
      });
    }

  </script>