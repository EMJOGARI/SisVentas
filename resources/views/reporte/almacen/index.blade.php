@extends ('layouts.admin')
@section('name', "Reportes de Almacén")
@section('content')
        <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Listado de Productos</a></li>
				<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Listado Precio Margen de Utilidad</a></li>
				<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
			</ul>
            <div class="tab-content">
	            <div class="tab-pane active" id="tab_1">
	                @include('reporte.almacen.existencia')
	            </div>
	            <div class="tab-pane" id="tab_2">
	                @include('reporte.almacen.utilidad')
	            </div>
            </div>
          </div>
@endsection