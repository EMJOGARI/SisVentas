<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Detalle Venta</title>
	<style>
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
			
		}
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		
	</style>
</head>
<body>
	<h2>Detalle Venta</h2>
	
	<table>
		<tr style="background-color: #dddddd;">
			<th>Cliente</th>
			<th>Comprobante</th>			
		</tr>
		<tr>
			<td>{{ $venta->nombre }}</td>
			<td>{{ $venta->tipo_comprobante.': '.$venta->serie_comprobante.' - '.$venta->num_comprobante }}</td>
		</tr>
	</table>

	
	<table>
		<tr style="background-color: #dddddd;">
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>Precio Venta</th>
			<th>% Descuenta</th>
			<th>Subtotal</th>
		</tr>
			@foreach($detalles as $det)
				<tr>
					<td>{{ $det->articulo }}</td>
	            	<td>{{ $det->cantidad }}</td>	            	
	            	<td>{{ number_format($det->precio_venta, 2, ',', '.') }}</td>
	            	<td>{{ $det->descuento }}</td>
	            	<td>
	            		{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</td>
				</tr>
			@endforeach	
		<tr>
			<th></th>						  		
	  		<th></th>
	  		<th></th>
	  		<th><h4>TOTAL:</h4></th>
	  		<th><h4 id="total">{{ number_format($venta->total_venta, 2, ',', '.') }}</h4></th>
		</tr>
	</table>
	
	
</body>
</html>