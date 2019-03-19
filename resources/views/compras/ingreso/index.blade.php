@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Historial de Compras <a href="{{ url('compras/ingreso/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>
				<a href="{{ url('pdf/reporteingreso') }}" target="_blank">
					<button class="btn btn-info"><i class="fa fa-print"></i> Reporte de Ingreso</button>
				</a>
			</h3>
			@include('compras.ingreso.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Comprobante</th>
						<th>Total</th>						
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach ($ingresos as $ing)
						<tr>
							<td>{{ $ing->fecha_hora }}</td>
							<td>{{ $ing->nombre }}</td>
							<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.' - '.$ing->num_comprobante }}</td>
							<td>{{ number_format($ing->total, 2, ',', '.') }}</td>
							<td>{{ $ing->estado }}</td>							
							<td>															
								<a href="{{ URL::action('IngresoController@show',$ing->idingreso) }}"><button class="btn btn-primary"><i class="fa fa-file-text-o"></i> Detalles</button></a> 
								<a href="" data-target="#modal-delete-{{ $ing->idingreso }}" data-toggle="modal"> <button class="btn btn-danger"><i class="fa fa-close"></i> Anular</button></a>
							</td>
						</tr>
						@include('compras.ingreso.modal')						
					@endforeach
				</table>
			</div>
			{{ $ingresos->render() }}	
		</div>
	</div>
@endsection

