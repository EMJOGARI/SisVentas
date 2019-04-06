@extends ('pdf.reporte')

@section('title', "Reporte de Ventas")

@section('content')
	<h2>Reporte de Ventas</h2>
	<table width="100%">
		<tr style="background-color: #dddddd;">
			<th width="15%">Fecha</th>			
			<th width="45%">Cliente</th>
			<th width="25%">Comprobante</th>
			<th width="15%">Total</th>						
			<th width="10%">Estado</th>
						
		</tr>		
		@foreach ($ventas as $ven)
			<tr>												
				<td style="text-align: center;">{{ date('d/m/Y', strtotime($ven->fecha_hora)) }}</td>
				<td>{{ $ven->nombre }}</td>
				<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
				<td style="text-align: right;">{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
				<td style="text-align: center;">{{ $ven->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
@endsection