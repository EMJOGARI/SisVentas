@extends ('layouts.admin')
@section('name', "Reportes de Ventas")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">			
			@include('reporte.venta.venta-vendedor.search')	
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
					<th width="30%">Vendedor</th>
					<th width="15%">Categoria</th>
					<th width="5%">Cantidad</th>
					<th width="10%">Precio Venta</th>
					<th width="10%">Neto</th>
				</thead>
				@foreach ($ventas as $ven)
					<tr>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
						<td>{{ $ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>						
						<td>{{ $ven->vendedor}}</td>
						<td>{{ $ven->categoria }}</td>
						<td align="center">{{ $ven->cantidad }}</td>
						<td align="right">{{ number_format($ven->precio_venta, 2, ',', '.') }}</td>
						<td align="right">{{ number_format($ven->cantidad * $ven->precio_venta, 2, ',', '.') }}</td>
					</tr>
				@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>						
						<td align="center"><strong>TOTAL:</strong></td>
						<td></td>
						<td align="right"><strong></strong></td>
					</tr>
			</table>
		</div>
		{{ $ventas->render() }}
	</div>
</div>
@endsection