@if(Auth::user())
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <br>
        </div>
        <div class="pull-left info">
           @if(Auth::user())
           <p>{{Auth::user()->name}}</p>
           @endif
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Administracion</li>
        <li>
          <a href="{{route('admin.almacen.index')}}">
            <i class="fa fa-th"></i> <span>Almacen</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
      
        <li>
          <a href="{{route('admin.categoria.index')}}">
            <i class="fa fa-laptop"></i> <span>Categoria</span>
          </a>
        </li>

        <!-- <li>
          <a href="{{route('admin.detallestock.index')}}">
            <i class="fa fa-file"></i> <span>Stock</span>
          </a>
        </li> -->

        <li>
          <a href="{{route('admin.empresa.index')}}">
            <i class="fa fa-industry"></i> <span>Empresa</span>
          </a>
        </li>

        <!-- <li>
          <a href="{{route('admin.item.index')}}">
            <i class="fa fa-laptop"></i> <span>DetalleStock</span>
          </a>
        </li> 
        <!-- <li>
          <a href="{{route('admin.periodo.index')}}">
            <i class="fa fa-calendar"></i> <span>Periodo</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.stock.index')}}">
            <i class="fa fa-check"></i> <span>Stock</span>
          </a>
        </li> -->
        <li>
          <a href="{{route('admin.unidad.index')}}">
            <i class="fa fa-cube"></i> <span>Unidad</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.proveedor.index')}}">
            <i class="fa fa-cube"></i> <span>Proveedor</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.producto.index')}}">
            <i class="fa fa-cube"></i> <span>Producto</span>
          </a>
        </li>
        <!-- <li class="header">Calculo</li>
        <li class=" treeview">
          <a href="">
            <i class="fa fa-cube "></i> <span>Unidad</span>
          </a>
        </li>
       <li class="header">Pagos</li>
        <li class=" treeview">
          <a href="">
            <i class="fa fa-cube "></i> <span>Empleado</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Dashboard </a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Dashboard </a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  @endif