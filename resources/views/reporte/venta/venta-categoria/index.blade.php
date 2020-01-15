@extends ('layouts.admin')
@section('name', "Reportes de Ventas por Categorias")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.venta.venta-categoria.search')
		</div>
	</div>
</div>

<div class="row">{{--col-lg-offset-2 col-md-offset-2 col-sm-offset-2 --}}
	@foreach ($vendedor as $ven)
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="box-header with-border">
		        <h3 class="box-title"><strong>{{$ven->idpersona.' - '.$ven->nombre }}</strong></h3>
	        </div>
		</div>
	@endforeach
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@include('reporte.venta.venta-categoria.venta')
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@include('reporte.venta.venta-categoria.nota')
		</div>
		<div class="col-xs-offset-3 col-xs-6">
			@include('reporte.venta.venta-categoria.detalle')
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: none">
			{{ $vendedor->appends(Request::all())->render() }}
		</div>

</div>
@endsection