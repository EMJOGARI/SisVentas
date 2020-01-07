@extends ('pdf.reporte')

@section('title', "Conmision Vendedor")

@section('content')
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
@endsection