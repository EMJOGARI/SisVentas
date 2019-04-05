@extends ('pdf.reporte')

@section('title', "Detalle del Ingreso")

@section('content')
<h2>Detalle del Ingreso</h2>
	
	<table>
		<tr style="background-color: #dddddd;">
			<th>Proveedor</th>
			<th>Comprobante</th>			
		</tr>
		<tr>
			<td>{{ $ingresos->nombre }}</td>
			<td>{{ $ingresos->tipo_comprobante.': '.$ingresos->serie_comprobante.' - '.$ingresos->num_comprobante }}</td>
		</tr>
	</table>

	
	<table>
		<tr style="background-color: #dddddd;">
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>Precio Unitario</th>
			<th>Subtotal</th>
		</tr>
			@foreach($detalles as $det)
				<tr>
					<td>{{ $det->articulo }}</td>
	            	<td>{{ $det->cantidad }}</td>
	            	<td>{{ number_format($det->precio_compra, 2, ',', '.') }}</td>
	            	<td>{{ number_format($det->cantidad*$det->precio_compra, 2, ',', '.') }}</td>
				</tr>
			@endforeach	
		<tr>
			<th></th>						  		
	  		<th></th>
	  		<th><h4>TOTAL:</h4></th>
	  		<th><h4 id="total">{{ number_format($ingresos->total, 2, ',', '.') }}</h4></th>
		</tr>
	</table>	
@endsection