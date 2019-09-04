<header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Stock</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top menutoken">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="menuButton">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      {{-- <a href="" value="http://localhost:8000/proyecto/inventario/public/public"  class="btn bg-green margin">
      <i class="fa fa-inbox menutoken"></i> Stock
      </a>
      <a href="" value="http://localhost:8000/calculo/public"  class="btn bg-green margin">
      <i class="fa fa fa-cogs"></i> Calculo
      </a>
      <a href="" value="http://localhost:9000/home"  class="btn bg-green margin">
      <i class="fa fa-user"></i> Usuarios
      </a> --}}
      <!-- <a href="" value="http://localhost:8000/pagos/public" class="btn bg-green margin">
      <i class="fa fa fa-money"></i> Pagos
      </a> -->
      {{-- <a href="" value="http://localhost:8000/fases/public" class="btn bg-green margin">
      <i class="fa fa-calendar-check-o"></i> Fases
      </a> --}}

      <button class="btn bg-green margin" onclick="navigateToOtherModule('inventario')"><i class="fa fa-inbox"></i> Stock  </button>
      <button class="btn bg-green margin" onclick="navigateToOtherModule('calculo')"><i class="fa fa-inbox"></i> Calculo  </button>
      <button class="btn bg-green margin" onclick="navigateToOtherModule('usuarios')"><i class="fa fa-user"></i> Usuarios  </button>
      <button class="btn bg-green margin" onclick="navigateToOtherModule('fases')"><i class="fa fa-user"></i> Fases  </button>

      <div class="navbar-custom-menu">
      
        <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
            <span id="usuarioSistema" class="btn bg-green margin"></span>
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
$urlParam=function(name){
    var  results=new RegExp('[\?&]'+name+'=([^&#]*)').exec(window.location.href);
    return results[1]||0;
  }
var urlToken=$urlParam('token');
if(urlToken!==''){
  localStorage.setItem('token',urlToken);
}
$("#salirSistema").click(function(){
  localStorage.setItem('token','');
  window.location.href =  sessionStorage.getItem('servidor_logueo')
});

  verifyMenu();
  function verifyMenu(){
    if(localStorage.getItem('menu')==null ){
      localStorage.setItem('menu',0);
      }else if (localStorage.getItem('menu')==0){
        $('body').attr('class','hold-transition skin-green sidebar-mini');
      } else if(localStorage.getItem('menu')==1){
        $('body').attr('class','hold-transition skin-green sidebar-mini sidebar-collapse');
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
  });
  $(".menutoken a").hover(function(){
    var url=$(this).attr('value')+"?token="+localStorage.getItem('token');
    $(this).attr('href',url);
  });

  function navigateToOtherModule(name) {
  var urlRedirect = '';
  if(name != 'usuarios')
    urlRedirect = "http://localhost:8000/proyecto/"+name+"/public/home?token="+localStorage.getItem('token');
  else
    urlRedirect = "http://localhost:9000/home?token="+localStorage.getItem('token');

  $.ajax({
        url:urlRedirect,
        success: function (data) { 
            window.location = urlRedirect;
        },
        error: function (jqXHR, status, er) {
          showError( "El dominio  "+ (new URL(urlRedirect)).origin + " no esta disponible.")
        }
    });
} 
  </script>