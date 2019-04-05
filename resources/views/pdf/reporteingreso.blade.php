@extends ('pdf.reporte')

@section('title', "Reporte de Ingresos")

@section('content')
	<h2>Reporte de Ingresos</h2>
	<table>
		<tr style="background-color: #dddddd;">
			<th>Fecha</th>			
			<th>Proveedor</th>
			<th>Comprobante</th>
			<th>Total</th>						
			<th>Estado</th>						
		</tr>		
		@foreach ($ingresos as $ing)
			<tr>												
				<td>{{ $ing->fecha_hora }}</td>
				<td>{{ $ing->nombre }}</td>
				<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.' - '.$ing->num_comprobante }}</td>
				<td>{{ number_format($ing->total, 2, ',', '.') }}</td>
				<td>{{ $ing->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
@endsection