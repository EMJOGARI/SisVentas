<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Reporte de Ventas</title>
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
				<td>{{ $ven->fecha_hora }}</td>
				<td>{{ $ven->nombre }}</td>
				<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</td>
				<td>{{ number_format($ven->total_venta, 2, ',', '.') }}</td>
				<td>{{ $ven->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
	
</body>
</html>