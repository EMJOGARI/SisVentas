@extends ('pdf.reporte')

@section('title', "Reporte de Ingresos")

@section('content')
	<h2>Reporte de Ingresos</h2>
	<table width="100%">
		<tr style="background-color: #dddddd;">
			<th width="15%">Fecha</th>			
			<th width="45%">Proveedor</th>
			<th width="25%">Comprobante</th>
			<th width="15%">Total</th>						
			<th width="10%">Estado</th>						
		</tr>		
		@foreach ($ingresos as $ing)
			<tr>												
				<td style="text-align: center;">{{ $ing->fecha_hora }}</td>
				<td>{{ $ing->nombre }}</td>
				<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.' - '.$ing->num_comprobante }}</td>
				<td style="text-align: right;">{{ number_format($ing->total, 2, ',', '.') }}</td>
				<td style="text-align: center;">{{ $ing->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
@endsection