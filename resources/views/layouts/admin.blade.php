<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SisVentas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/assets/css/_all-skins.min.css') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/img/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}">

  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('principal/index') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>V</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SisVentas</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">                  
                  <i class="fa fa-user"></i><span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header"> 
                    <p>
                      Desarrollando Software
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">

                      <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Cerrar') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li><a href="{{ url('principal/index') }}"><i class="fa fa-home"></i> {{ __('inicio') }}</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('almacen/articulo/create') }}"><i class="fa fa-th-large"></i>Nuevo Artículo</a></li>
                <li><a href="{{ url('almacen/articulo/') }}"><i class="fa fa-th-list"></i>Listado de Artículo</a></li>
                <li><a href="{{ url('almacen/categoria') }}"><i class="fa fa-tag"></i> Categorías</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('compras/ingreso/create') }}"><i class="fa fa-shopping-cart"></i>Nueva Compra</a></li>
                <li><a href="{{ url('compras/ingreso/') }}"><i class="fa fa-th"></i>Historial de Compras</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Facturacion</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('ventas/venta/create') }}"><i class="fa fa-cart-plus"></i>Nueva Venta <strong>DECONTADO</strong></a></li>
                <li><a href="{{ url('ventas/venta/credito/create') }}"><i class="fa fa-cart-plus"></i>Nueva Venta <strong>CREDITO</strong></a></li>
                <li><a href="{{ url('ventas/venta') }}"><i class="fa fa-list-alt"></i>Administrar Facturas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-signal"></i>
                <span>Reportes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('pdf/reportearticuloprecio') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Lista de Precio Productos</a></li>
                <li><a href="{{ url('pdf/reportearticulo') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Inventario</a></li>
                <li><a href="{{ url('pdf/reporteventa') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Ventas</a></li>
                <li><a href="{{ url('pdf/reporteingreso') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Ingresos</a></li>                
              </ul>
            </li>
            <li><a href="{{ url('seguridad/persona') }}"><i class="fa fa-user"></i><span>Personas</span></a></li>
            @if(Auth::user()->idrol=='1')
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-wrench"></i>
                  <span>Configuraciones</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ url('seguridad/usuario') }}"><i class="fa fa-users"></i> {{ __('Ver Usuarios') }}</a></li>
                  <li><a href="{{ url('seguridad/precio_articulo') }}"><i class="fa fa-refresh"></i> {{ __('Cambiar precio producto') }}</a></li>
                </ul>
              </li>
            @endif

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><strong>@yield('name')</strong></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">

	                  	<div class="col-md-12">
                          <!--Contenido-->
                          @include('flash::message')
                          @yield('content')
                          <!--Fin Contenido-->
                      </div>
                    </div>		                    
                </div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2015-2020 </strong> All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4  new-ingreso.js-->
    <script src="{{ asset('/assets/js/jQuery-2.1.4.min.js') }}"></script>
    @stack('scripts')
    <script>
      $('div.alert').not('.alert-important').delay(3000).fadeOut(250);
    </script>
   
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
   
  </body>
</html>
