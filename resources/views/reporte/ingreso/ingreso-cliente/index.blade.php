@extends ('layouts.admin')
@section('name', "Volumen de Cobranzas por Clientes y Vendedor")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.ingreso.ingreso-cliente.search')
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
		<a href="{{ url('pdf/reportearticuloprecio') }}"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button></a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="10%">F. Creada</th>
					<th width="10%">Factura Nº</th>
					<th width="30%">Cliente</th>
					<th width="10%">F. Entrega</th>
					<th width="10%">F. Pagada</th>
					<th width="5%">Dias</th>
					<th width="5%">Vendedor</th>
					<th width="5%">Estado</th>
					<th width="10%">Neto</th>
					<th width="5%"></th>
				</thead>
				@foreach ($ventas as $ven)
					<tr>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</td>
						<td>{{ $ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
						<td>{{ str_pad($ven->idcliente, 3, "0", STR_PAD_LEFT).' - '.$ven->nombre }}</td>
						<td align="center">
							@if($ven->fecha_entrega > $ven->fecha_hora)
								{{ date('d-m-Y', strtotime($ven->fecha_entrega)) }}
							@endif
						</td>
						<td align="center">
							@if($ven->fecha_entrega > $ven->fecha_hora)
								{{ date('d-m-Y', strtotime($ven->fecha_pagada)) }}
							@endif
						</td>
						<td align="center">
							@if( $ven->fecha_pagada > $ven->fecha_entrega)
								<?php
									$StarDate = strtotime($ven->fecha_entrega);
									$EndDate = strtotime($ven->fecha_pagada);
									$cont = 0;
									for($StarDate;$StarDate<=$EndDate;$StarDate=strtotime('+1 day ' . date('Y-m-d',$StarDate)))
									{
									    if((strcmp(date('D',$StarDate),'Sun')!=0) and (strcmp(date('D',$StarDate),'Sat')!=0))
									    {
									    	$cont = $cont + 1;
		    							}
									}
									echo $cont;
			    				?>
							@endif
						</td>
						<td align="center">{{ $ven->idvendedor }}</td>
						<td align="center">
								@if($ven->estado == 'Pagada')
									<span class="label label-success">{{ $ven->estado }}</span>
										@if($ven->total_noce > 0)
											<span class="label label-info">NC</span>
										@endif
								@endif
						</td>
						<td align="right">{{ number_format($ven->total_venta - $ven->total_noce, 2, ',', '.') }}</td>
						<td>
							<a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><button class="btn btn-default"><i class="fa fa-eye"></i></button></a>
						</td>
					</tr>
					@include('ventas.venta.modal')
				@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align="center"><strong>TOTAL:</strong></td>
						<td align="right"><strong>{{ number_format($sum_total_venta, 2, ',', '.') }}</strong></td>
						<td></td>
					</tr>
			</table>
		</div>
		{{ $ventas->render() }}
	</div>
</div>
@endsection