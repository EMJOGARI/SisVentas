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
						<th width="8%">Fecha</th>
						<th width="25%">Cliente</th>
						<th width="5%">Vendedor</th>
						<th width="15%">Comprobante</th>
						<th width="10%">Monto Factura</th>
						<th width="10%">Nota Credito</th>
						<th width="10%">Total Pagar</th>
						<th width="5%">Dias V.</th>
						<th width="7%">Estado</th>
						<th width="13%"></th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
							<td>{{ $ven->nombre }}</td>
							<td>{{ $ven->idvendedor }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td align="right">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
							<td align="right">
								@foreach ($noces as $no)
									@if($no->idventa == $ven->idventa)
										{{ number_format($no->total_noce, 2, ',', '.') }}
									@endif
								@endforeach
							</td>
							<td align="right">
								@foreach ($noces as $no)
									@if($no->idventa == $ven->idventa)
										{{ number_format($ven->total_venta - $no->total_noce, 2, ',', '.') }}
									@endif
								@endforeach
							</td>
							<td align="center">
								@if($ven->estado == 'Pagada')
									<span class="label label-success">{{ $ven->estado }}</span>
								@elseif($ven->estado == 'Anulada')
									<span class="label bg-red">{{ $ven->estado }}</span>
								@else
									<span class="label bg-yellow">{{ $ven->estado }}</span>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><i class="fa fa-file-text-o"></i> Detalle Factura</a></li>ssss
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{ $ventas->appends(Request::all())->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

