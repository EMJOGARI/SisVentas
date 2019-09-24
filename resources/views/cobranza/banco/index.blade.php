@extends ('layouts.admin')

@section('name', "Banco")

@section('content')
	<div class="row">
		@include('cobranza.banco.search')
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="10%">Fecha</th>
						<th width="30%">Cliente</th>
						<th width="20%">Vendedor</th>
						<th width="15%">Comprobante</th>
						<th width="10%">Total</th>
						<th width="10%">Estado</th>
						<th width="15%"></th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
							<td>{{ $ven->nombre }}</td>
							<td>{{ $ven->vendedor }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td align="right">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
							<td align="center">
								@if($ven->estado == 'Pagada')
									<span class="label label-success">{{ $ven->estado }}</span></td>
								@elseif($ven->estado == 'Anulada')
									<span class="label bg-red">{{ $ven->estado }}</span></td>
								@else
									<span class="label bg-yellow">{{ $ven->estado }}</span></td>
								@endif
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><i class="fa fa-file-text-o"></i> Detalle Factura</a></li>

										<li><a href="{{ URL::action('ReporteController@ReporteVentaID',$ven->idventa) }}" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver PDF</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{ $ventas->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

