@extends ('layouts.admin')

@section('name', "Notas de Credito")

@section('content')
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
			@include('ventas.nota-de-credito.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="10%">Fecha</th>
						<th width="40%">Cliente</th>
						<th width="10%">Nº Factura</th>
						<th width="5%">Nota C.</th>
						<th width="10%">Total</th>
						<th width="10%">Estado</th>
						<th width="15%"></th>
					</thead>
					@foreach ($noces as $no)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($no->fecha)) }}</td>
							<td>{{ $no->nombre }}</td>
							<td align="right">{{ $no->serie_comprobante.' - '.$no->num_comprobante }}</td>
							<td align="right">{{ $no->num_noce.' - '.$no->serie_noce }}</td>
							<td align="right">{{ number_format($no->total_noce, 2, ',', '.') }}</td>
							<td align="center">
								@if($no->estado == 'Pagada')
									<span class="label label-success">{{ $no->estado }}</span>
								@elseif($no->estado == 'Anulada')
									<span class="label bg-red">{{ $no->estado }}</span>
								@else
									<span class="label bg-yellow">{{ $no->estado }}</span>
								@endif
							</td>
							<td>

								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::action('VentaController@show',$no->idventa) }}"><i class="fa fa-file-text-o"></i> Detalle Factura</a></li>

										<li><a href="{{ URL::action('ReporteController@ReporteNotaCredito',$no->idnoce) }}" target="_blank"><i class="fa fa-file-pdf-o"></i> Imprimir</a></li>

										<li><a href="#" data-target="#modal-delete-{{ $no->idnoce }}" data-toggle="modal"><i class="fa fa-trash"></i> Eliminar Nota</a></li>
									</ul>
								</div>
								{{----}}
							</td>
						</tr>
						@include('ventas.nota-de-credito.modal')
						{{----}}
					@endforeach
				</table>
			</div>
			{{ $noces->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

