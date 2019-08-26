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
      
      <ul class="sidebar-menu" data-widget="tree" id="menutoken">
      <!-- roles -->
      <div  class="sidebar-menu" data-widget="tree"  id="roles" style="display:none"> <!-- style="display:none"  -->
        <li>
          <a href="" value="categoria">
            <i class="fa fa-briefcase"></i> <span>Categorias</span>
          </a>
        </li> 
        <li>
          <a href="" value="unidad">
            <i class="fa fa-clone"></i> <span>Unidades</span>
          </a>
        </li>    
<!-- 
        <li class="treeview">
          <a href="">
            <i class="fa fa-pie-chart"></i>
            <span>Salidas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
          </ul>
        </li> -->
        <li><a href="" value="salida"><i class="fa fa-sign-out"></i> <span>Nueva Salida</span></a></li>
          <li><a href="" value="salidaLista"><i class="fa fa-server"></i> <span>Listar Salidas</span></a></li>
        <li>
          <a href="" value="item">
            <i class="fa fa-shopping-cart"></i> <span>Productos</span>
          </a>
        </li> 
        <!-- <li>
          <a href="" value="empresa">
            <i class="fa fa-laptop"></i> <span>Empresa</span>
          </a>
        </li>  -->
        </div>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
  $("#menutoken li a").hover(function(){
     var url=window.location.origin+"/proyecto/inventario/public/"+$(this).attr('value')+"?token="+localStorage.getItem('token');
     $(this).attr('href',url);
    });

    setMenu ();
    function setMenu (){
      $.ajax({
        type: 'POST',
        url:{!!json_encode(url('/'))!!}+"/api/setMenu?token="+localStorage.getItem('token'),
        data:{},
        success: function(result) {
                if(result.data=="stock"){
                  $("#roles").show();
                } 
         $("#usuarioSistema").html("Hola, "+result.user);
        },
        error: function(e) {}
      });
    }

    function navigateToOtherModule(name) {
    if(name != 'usuarios')
      window.location = "http://localhost:8000/proyecto/"+name+"/public/home?token="+localStorage.getItem('token');
    else
      window.location = "http://localhost:9000/home?token="+localStorage.getItem('token');
    } 
  </script>