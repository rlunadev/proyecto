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
      <div  class="sidebar-menu" data-widget="tree"  id="roles" style="display:none"> 
        <li>
          <a href="" value="parametro">
            <i class="fa fa-laptop"></i> <span>Parametros</span>
          </a>
        </li> 
        <li>
          <a href="" value="formulaDetalle">
            <i class="fa fa-laptop"></i> <span>Formulas</span>
          </a>
        </li> 
       
        <li>
          <a href="" value="modulo">
            <i class="fa fa-laptop"></i> <span>Modulos</span>
          </a>
        </li> 
        
        <li>
          <a href="" value="proyecto">
            <i class="fa fa-laptop"></i> <span>Proyectos</span>
          </a>
        </li> 

        <li>
          <a href="" value="formula">
            <i class="fa fa-laptop"></i> <span>Lista de Formulas</span>
          </a>
        </li> 
        <!-- <li>
          <a href="" value="listamodulo">
            <i class="fa fa-laptop"></i> <span>Lista de Modulos</span>
          </a>
        </li>  -->
        <li>
          <a href="" value="listaproyecto">
            <i class="fa fa-laptop"></i> <span> Lista de Proyectos</span>
          </a>
        </li> 
        </div>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
  $("#menuIzquierda li a").hover(function(){
     var url=window.location.origin+"/calculo/public/"+$(this).attr('value')+"?token="+localStorage.getItem('token');
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
            $.each(result.data, function(index, value) {
              if(value.rol=="admin" && value.sistema=="calculo"){
                $("#roles").show();
              }  
            });
          }
          
         $("#usuarioSistema").html("Hola, "+result.user);
        },
        error: function(e) {}
      });
    }
  </script>