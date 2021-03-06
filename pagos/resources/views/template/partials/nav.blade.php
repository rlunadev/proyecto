<header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Pagos</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="menuButton">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a href="http://localhost:8000/inventario/public/"  class="btn bg-purple margin">
      <i class="fa fa-inbox"></i> Stock
      </a>
      <a href="http://localhost:8000/calculo/public/"  class="btn bg-purple margin">
      <i class="fa fa fa-cogs"></i> Calculo
      </a>
      <a href="http://localhost:8000/token_service/public/"  class="btn bg-purple margin">
      <i class="fa fa-user"></i> Usuarios
      </a>
      <a href="http://localhost:8000/pagos/public/"  class="btn bg-purple margin">
      <i class="fa fa-money"></i> Pagos
      </a>
      <a href="http://localhost:8000/fases/public/"  class="btn bg-purple margin">
      <i class="fa fa-calendar-check-o"></i> Fases
      </a>

      <div class="navbar-custom-menu">
      
        <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
            <a href="#" id="usuarioSistema"></a>
          </li>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="salirSistema">
              <i class="fa fa-exit-o"></i>Salir
            </a>
          </li>
        </ul>
      </div>
      
    </nav>
  </header>
  <script>
$("#salirSistema").click(function(){
  localStorage.setItem('token','');
  window.location.href =  sessionStorage.getItem('ruta_inicial')
});

  verifyMenu();
  function verifyMenu(){
    if(localStorage.getItem('menu')==null ){
      localStorage.setItem('menu',0);
      }else if (localStorage.getItem('menu')==0){
        $('body').attr('class','hold-transition skin-purple sidebar-mini');
      } else if(localStorage.getItem('menu')==1){
        $('body').attr('class','hold-transition skin-purple sidebar-mini sidebar-collapse');
      }
  }
  $('#menuButton').click(function(){
    var statusMenu=localStorage.getItem('menu');
    if(statusMenu==0){
      localStorage.setItem('menu',1);
    }
    else {
      localStorage.setItem('menu',0);
    }
     
    //verifyMenu();
  });
  </script>