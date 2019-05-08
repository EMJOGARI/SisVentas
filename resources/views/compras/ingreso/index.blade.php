@extends ('layouts.admin')
@section('name', "Historial de Compras")
@section('content')
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">			
			<a href="{{ url('compras/ingreso/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Ingreso</button></a>
		</div>
		<div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-lg-5 col-md-5 col-sm-5 col-xs-12">			
			@include('compras.ingreso.search')			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="10%">Fecha</th>
						<th width="40%">Proveedor</th>
						<th width="15%">Comprobante</th>
						<th width="10%">Total</th>						
						<th width="5%">Estado</th>
						<th width="15%"></th>
					</thead>
					@foreach ($ingresos as $ing)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ing->fecha_hora)) }}</td>
							<td>{{ $ing->nombre }}</td>
							<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.' - '.$ing->num_comprobante }}</td>
							<td align="right">{{ number_format($ing->total, 2, ',', '.') }}</td>
							<td align="center">{{ $ing->estado }}</td>							
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::action('IngresoController@show',$ing->idingreso) }}"><i class="fa fa-file-text-o"></i> Detalle Ingreso</a></li>

										<li><a href="#" data-target="#modal-delete-{{ $ing->idingreso }}" data-toggle="modal"><i class="fa fa-trash"></i> Anular Ingreso</a></li>
									</ul>
								</div>
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

