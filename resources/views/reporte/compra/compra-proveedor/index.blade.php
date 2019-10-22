@extends ('layouts.admin')
@section('name', "Reportes de Ventas por Clientes y Municipio")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.compra.compra-proveedor.search')
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="10%">Fecha</th>
					<th width="15%">Factura Nº</th>
					<th width="40%">Proveedor</th>
					<th width="15%">Municipio</th>
					<th width="10%">Estado</th>
					<th width="10%">Neto</th>
					<th width="5%"></th>
				</thead>
				@foreach ($ingresos as $ing)
					<tr>
						<td align="center">{{ date('d-m-Y', strtotime($ing->fecha_hora)) }}</td>
						<td>{{ $ing->serie_comprobante.' - '.$ing->num_comprobante }}</td>
						<td>{{ str_pad($ing->idproveedor, 3, "0", STR_PAD_LEFT).' - '.$ing->nombre }}</td>
						<td>{{ $ing->municipio }}</td>
						<td align="center">{{--
								@if($ven->estado == 'Pagada')
									<span class="label label-success">{{ $ven->estado }}</span>
								@else
									<span class="label bg-yellow">{{ $ven->estado }}</span>
								@endif--}}
						</td>
						<td align="right">{{ number_format($ing->total_compra, 2, ',', '.') }}</td>
						<td>
							<a href="{{ URL::action('IngresoController@show',$ing->idingreso) }}"><button class="btn btn-default"><i class="fa fa-eye"></i></button></a>
						</td>
					</tr>
				@include('compras.ingreso.modal')
				@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align="center"><strong>TOTAL:</strong></td>
						<td align="right"><strong>{{ number_format($sum_total_compra, 2, ',', '.') }}</strong></td>
						<td></td>
					</tr>{{----}}
			</table>
		</div>
		{{ $ingresos->render() }}
	</div>
</div>
@endsection