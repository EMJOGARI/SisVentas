@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Ventas <a href="{{ url('ventas/venta/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>
				<a href="{{ url('pdf/reporteventa') }}" target="_blank">
					<button class="btn btn-info"><i class="fa fa-print"></i> Reporte de Ventas</button>
				</a>
			</h3>
			@include('ventas.venta.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Comprobante</th>
						<th>Total</th>						
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td>{{ $ven->fecha_hora }}</td>
							<td>{{ $ven->nombre }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td>{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
							<td>{{ $ven->estado }}</td>							
							<td>
								<a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><button class="btn btn-primary"><i class="fa fa-file-text-o"></i> Detalles</button></a>
								<a href="{{ URL::action('ReporteController@ReporteVentaID',$ven->idventa) }}" target="_blank"><button class="btn btn-success"><i class="fa fa-print"></i> Copia</button></a>
								<a href="" data-target="#modal-delete-{{ $ven->idventa }}" data-toggle="modal"> <button class="btn btn-danger"><i class="fa fa-close"></i> Anular</button></a>
							</td>
						</tr>
						@include('ventas.venta.modal')						
					@endforeach
				</table>
			</div>
			{{ $ventas->render() }}	
		</div>
	</div>
@endsection

