@extends ('layouts.admin')

@section('name', "Analisis de Vencimientor")

@section('content')
	<div class="row">
		@include('cobranza.cuenta-por-cobrar.search')
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
						<th width="0%">Total</th>
						<th width="0%">0 - 3</th>
						<th width="0%">4 - 7</th>
						<th width="0%">8 +</th>
					</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
							<td>{{ $ven->nombre }}</td>
							<td>{{ $ven->vendedor }}</td>
							<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
							<td align="right">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
							<td align="center">
								@if(($ven->dia = 0) & ($ven->dia <= 3)) 
									{{ $ven->dia }}							
								@endif
							</td>
							<td align="center">
								@if(($ven->dia >= 4) && ($ven->dia <= 7))
									{{ $ven->dia }}							
								@endif
							</td>
							<td align="center">
								@if($ven->dia >= 8) 
									{{ $ven->dia }}							
								@endif
							</td>							
							
						</tr>
						@include('cobranza.cuenta-por-cobrar.modal-pagar')

					@endforeach
				</table>
			</div>
			{{ $ventas->appends(Request::all())->render() }}
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	</div>
@endsection

