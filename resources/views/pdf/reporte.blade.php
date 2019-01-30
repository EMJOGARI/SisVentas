<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Articulos</title>
	<style>
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even){
			background-color: #dddddd;
		}
	</style>
</head>
<body>
	<h2>Reporte de Articulos</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Codigo</th>
			<th>Categoria</th>
			<th>Stock</th>
			<th>Costo</th>
			<th>Estado</th>
		</tr>		
		@foreach ($articulos as $art)
			<tr>												
				<td>{{ $art->idarticulo }}</td>
				<td>{{ $art->nombre }}</td>
				<td>{{ $art->codigo }}</td>
				<td>{{ $art->categoria }}</td>
				<td>{{ $art->stock }}</td>	
				<td>{{ $art->costo }}</td>						
				<td>{{ $art->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
	
</body>
</html>