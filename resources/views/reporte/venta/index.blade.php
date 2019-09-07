@extends ('layouts.admin')
@section('name', "Reportes de Ventas")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				@include('reporte.venta.fecha')
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				@include('reporte.venta.cliente')
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				@include('reporte.venta.vendedor')
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				@include('reporte.venta.municipio')
			</div>
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
		<a href="{{ url('pdf/reportearticuloprecio') }}"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button></a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="10%">Fecha</th>
					<th width="10%">Factura Nº</th>
					<th width="30%">Cliente</th>
					<th width="15%">Municipio</th>
					<th width="30%">Vendedor</th>
					<th width="10%">Neto</th>
				</thead>
				@foreach ($ventas as $ven)
					<tr>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
						<td>{{ $ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
						<td>{{ $ven->nombre }}</td>
						<td>{{ $ven->municipio }}</td>
						<td>{{ $ven->vendedor}}</td>
						<td align="right">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
					</tr>
				@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align="center"><strong>TOTAL:</strong></td>
						<td align="right"><strong>{{ number_format($sum_total_venta, 2, ',', '.') }}</strong></td>
					</tr>
			</table>
		</div>
		{{ $ventas->render() }}
	</div>
</div>
@endsection