<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Detalle Venta</title>
	<style>
		/*html {
			margin: 0;
		}
		body {
			
			margin: 45mm 8mm 2mm 8mm;
		}*/
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
	<h2>Detalle Venta </h2>
	<p >{{ date('d-m-Y') }}</p>
	<table>
		<tr style="background-color: #dddddd;">
			<th>Cliente</th>
					
		</tr>
		<tr>
			<td>{{ $venta->nombre }} </td>			
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