@extends ('layouts.admin')
@section('name', "Comisiones por Vendedor")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.venta.comisiones.search')
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
		<a href="{{ url('pdf/reportecomision') }}" target="_blank"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button></a>
	</div>
</div>
<div class="row">
	{{--
		@foreach ($vendedor as $ven)
		@endforeach
	--}}
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="40%">CLIENTE</th>
					<th width="15%">Nº FACTURA</th>
					<th width="15%">F. ENTREGA</th>
					<th width="15%">F. PAGADA</th>
					<th width="15%">MONTO FACTURA</th>
				</thead>
				@foreach ($ventas as $ven)
					<tr>
						<td align="left">{{ str_pad($ven->idcliente, 3, "0", STR_PAD_LEFT).' - '.$ven->nombre }}</td>
						<td align="center">{{ $ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_entrega)) }}</td>
						<td align="center">{{ date('d-m-Y', strtotime($ven->fecha_pagada)) }}</td>
						<td align="right">{{ number_format($ven->total_venta - $ven->total_noce, 2, ',', '.') }}</td>
					</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>TOTAL:</strong></td>
					<td align="right"><strong>{{ number_format($sum_total_venta, 2, ',', '.') }}</strong></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box box-success">
		    <div class="box-body"><!-- /.box-header -->
		      	<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th width="30%"></th>
							<th width="10%"></th>
						</thead>
							<tr>
								<td><strong>TOTAL VENTAS</strong></td>
								<td align="right">{{ number_format( $sum_total_venta, 2, ',', '.') }}</td>
							</tr>
							<tr>
								<td><strong>COMISIONES 3%</strong></td>
								<td align="right">{{ number_format( $sum_total_venta * 0.03, 2, ',', '.') }}</td>
							</tr>


					</table>
				</div>
		    </div><!-- /.box-body -->
		</div>
	</div>
</div>
@endsection