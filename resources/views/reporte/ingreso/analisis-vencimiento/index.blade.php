@extends ('layouts.admin')

@section('name', "Analisis de Vencimientor")

@section('content')
	<div class="row">
		@include('reporte.ingreso.analisis-vencimiento.search')
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" >
					<thead>
						<th width="0%">Fecha</th>
						<th width="0%">Cliente</th>
						<th width="0%">Vendedor</th>
						<th width="0%">Comprobante</th>
						<th width="0%">1 - 4 Días</th>
						<th width="0%">5 - 6 Días</th>
						<th width="0%">7 + Días</th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
							<td>{{ str_pad($ven->idcliente, 3, "0", STR_PAD_LEFT).' - '.$ven->nombre }}</td>
							<td>{{ str_pad($ven->idvendedor, 3, "0", STR_PAD_LEFT) }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td align="right">
								@if(($cont === 0) & ($cont <= 3))
									{{ number_format($ven->total_venta - $ven->total_noce, 2, ',', '.') }}
								@endif
							</td>
							<td align="right">
								@if(($cont >= 4) && ($cont <= 7))
									{{ number_format($ven->total_venta - $ven->total_noce, 2, ',', '.') }}
								@endif
							</td>
							<td align="right">
								@if($cont >= 8)
									{{ number_format($ven->total_venta - $ven->total_noce, 2, ',', '.') }}
								@endif
							</td>
						</tr>
					@endforeach
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td align="center"><strong>TOTAL</strong></td>
							<td align="right"><strong>{{ number_format($mar_1, 2, ',', '.') }}</strong></td>
							<td align="right"><strong>{{ number_format($mar_2, 2, ',', '.') }}</strong></td>
							<td align="right"><strong>{{ number_format($mar_3, 2, ',', '.') }}</strong></td>
						</tr>
				</table>
			</div>
			{{ $ventas->appends(Request::all())->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

