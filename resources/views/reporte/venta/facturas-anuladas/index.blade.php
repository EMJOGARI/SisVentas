@extends ('layouts.admin')
@section('name', "Reportes de Facturas Anuladas")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.venta.facturas-anuladas.search')
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
		<a href="#"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button></a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="10%">Fecha</th>
					<th width="10%">Factura Nº</th>
					<th width="40%">Cliente</th>
					<th width="20%">Vendedor</th>
					<th width="10%">Estado</th>
					<th width="10%">Neto</th>
				</thead>
				@foreach ($ventas as $ven)
					<tr>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
						<td>{{ $ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
						<td>{{ str_pad($ven->idcliente, 3, "0", STR_PAD_LEFT).' - '.$ven->nombre }}</td>
						<td>{{ str_pad($ven->idvendedor, 3, "0", STR_PAD_LEFT).' - '.$ven->vendedor }}</td>
						<td align="center"><span class="label bg-red">{{ $ven->estado }}</span></td>
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