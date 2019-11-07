@extends ('layouts.admin')

@section('name', "Listado de Ventas")

@section('content')
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<a href="{{ url('ventas/venta/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Factura</button></a>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">


		</div>
		<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-5 col-md-5 col-sm-5 col-xs-12">
			@include('ventas.venta.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="10%">Fecha</th>
						<th width="35%">Cliente</th>
						<th width="15%">Comprobante</th>
						<th width="10%">Total Factura</th>
						<th width="5%">Nota C.</th>
						<th width="10%">Estado</th>
						<th width="15%"></th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
							<td>{{ $ven->nombre }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td align="right">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
							<td align="center">
								@foreach ($noces as $no)
									@if($no->idventa == $ven->idventa)
										{{ str_pad($no->num_noce, 5, "0", STR_PAD_LEFT) }}
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
										<li><a href="{{ URL::action('ReporteController@ReporteFactura',$ven->idventa) }}" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver Factura</a></li>
										<li><a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><i class="fa fa-file-text-o"></i> Detalle Factura</a></li>
										<li><a href="#" data-target="#modal-delete-{{ $ven->idventa }}" data-toggle="modal"><i class="fa fa-trash"></i> Anular Factura</a></li>
									</ul>
								</div>
							</td>
						</tr>
						@include('ventas.venta.modal')
					@endforeach
				</table>
			</div>
			{{ $ventas->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

