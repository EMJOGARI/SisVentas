@extends ('pdf.reporte')

@section('title', "Reporte de Ventas")

@section('content')
	<h2>Reporte de Ventas</h2>
	<table>
		<tr style="background-color: #dddddd;">
			<th>Fecha</th>			
			<th>Cliente</th>
			<th>Comprobante</th>
			<th>Total</th>						
			<th>Estado</th>
						
		</tr>		
		@foreach ($ventas as $ven)
			<tr>												
				<td>{{ date('d/m/Y', strtotime($ven->fecha_hora)) }}</td>
				<td>{{ $ven->nombre }}</td>
				<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
				<td>{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
				<td>{{ $ven->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
@endsection