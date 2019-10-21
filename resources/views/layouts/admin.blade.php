<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SisVentas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/datetimepicker/css/bootstrap-datepicker3.min.css') }}">
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
            <li><a href="{{ url('principal/index') }}"><i class="fa fa-home"></i> Inicio</a></li>



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
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('ventas/venta/create') }}"><i class="fa fa-cart-plus"></i>Nueva Venta</a></li>
                <li><a href="{{ url('ventas/venta') }}"><i class="fa fa-list-alt"></i>Administrar Facturas</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>Cobranza</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('cobranza/cuenta-por-cobrar/') }}"><i class="fa fa-briefcase"></i>Cuentas por Cobrar</a></li>
                <li><a href="{{ url('cobranza/banco/') }}"><i class="fa fa-bank"></i>Banco</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cloud-download"></i>
                <span>Reportes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview menu">
                  <a href="#"><i class="fa fa-cubes"></i> Almacén
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: auto;">
                    <li><a href="{{ url('reporte/almacen/listado-producto') }}"><i class="fa fa-th"></i>Listado de Productos</a></li>
                    <li><a href="{{ url('reporte/almacen/margen-utilidad') }}"><i class="fa fa-th"></i>Margen de Utilidad</a></li>
                    <li><a href="{{ url('reporte/almacen/resumen-inventario') }}"><i class="fa fa-th"></i>Resumen Almacen</a></li>
                    <li><a href="{{ url('reporte/almacen/producto-mas-vendido') }}"><i class="fa fa-th"></i>Producto mas Vendidos</a></li>
                    <li><a href="{{ url('reporte/almacen/producto-menos-vendido') }}"><i class="fa fa-th"></i>Producto Menos Vendidos</a></li>
                  </ul>
                </li>
                <li class="treeview menu-open">
                  <a href="#"><i class="fa fa-line-chart"></i> Facturacion
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: auto;">
                    <li><a href="{{ url('reporte/venta/venta-cliente') }}"><i class="fa fa-th"></i>Ventas por Clientes</a></li>
                    <li><a href="{{ url('reporte/venta/venta-vendedor') }}"><i class="fa fa-th"></i>Ventas por Vendedor</a></li>
                    <li><a href="{{ url('reporte/venta/venta-categoria') }}"><i class="fa fa-th"></i>Ventas por Categoria</a></li>
                    <li><a href="{{ url('reporte/venta/facturas-anuladas') }}"><i class="fa fa-th"></i>Facturas Anuladas</a></li>

                  </ul>
                </li>
                <li class="treeview menu-open">
                  <a href="#"><i class="fa fa-line-chart"></i> Cobranzas
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: auto;">
                      <li><a href="{{ url('reporte/ingreso/ingreso-cliente') }}"><i class="fa fa-th"></i>Volumen de Cobranzas</a></li>
                      <li><a href="{{ url('reporte/ingreso/analisis-vencimiento') }}"><i class="fa fa-th"></i>Analisis de Vencimiento</a></li>
                  </ul>
                </li>
                 <li class="treeview menu-open">
                  <a href="#"><i class="fa fa-line-chart"></i> Compras
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: auto;">

                  </ul>
                </li>
                <li class="treeview menu">
                  <a href="#"><i class="fa fa-area-chart"></i> Ranking
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: auto;">
                    <li><a href="{{ url('reporte/ranking/municipio') }}"><i class="fa fa-th"></i>Ranking por Municipios</a></li>
                    <li><a href="{{ url('reporte/ranking/cliente') }}"><i class="fa fa-th"></i>Ranking por Clientes</a></li>
                  </ul>
                </li>

                <li><a href="{{ url('pdf/reportearticuloprecio') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Lista de Precio Productos</a></li>
                <li><a href="{{ url('pdf/reportearticulo') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Inventario Cero</a></li>
                {{--<li><a href="{{ url('pdf/reporteventa') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Ventas</a></li>
                <li><a href="{{ url('pdf/reporteingreso') }}" target="_blank"><i class="fa fa-file-pdf-o"></i>Reporte de Ingresos</a></li>--}}
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
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="row">
            <div class="col-md-4">
                <strong>Copyright &copy; 2015-2020 </strong> All rights reserved.
            </div>
            <div class="col-md-6">
              <p>Para Mayor Informacion: <strong><i class="fa fa-envelope"></i> ejgameror@gmail.com</strong> //  <strong><i class="fa fa-phone-square" ></i> (+58) 412-0948332</strong></p>
            </div>
            <div class="col-md-2">
                <strong style="font-size: 20px">{{ date('d-m-Y') }}</strong>
            </div>
        </div>


      </footer>


    <!-- jQuery 2.1.4  new-ingreso.js-->
    <script src="{{ asset('/assets/js/jQuery-2.1.4.min.js') }}"></script>
    @stack('scripts')
    <script>
      $('div.alert').not('.alert-important').delay(3000).fadeOut(250);
    </script>
    <script src="{{ asset('/assets/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/datetimepicker/js/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('/assets/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
      $('#FechaInicio').datepicker({
        format: 'dd-mm-yyyy',
        language: 'es',
        clearBtn: true,
        todayHighlight: true
       //startDate: moment()

      });
      $('#FechaFinal').datepicker({
          format: 'dd-mm-yyyy',
          language: "es",
          clearBtn: true,
          todayHighlight: true
          //endDate: moment()
      });

   </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
  </body>
</html>
