<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Lista de Clientes</title>
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
	<h2>Listado de Clientes</h2>
	<table>
		<tr style="background-color: #dddddd;">
			<th>Id</th>
			<th>Nombre</th>
			<th>Tipo Doc.</th>
			<th>Numero Doc.</th>
			<th>Telefono</th>
			<th>Email</th>
		</tr>		
		@foreach ($personas as $per)
			<tr>												
				<td>{{ $per->idpersona }}</td>
				<td>{{ $per->nombre }}</td>
				<td>{{ $per->tipo_documento }}</td>
				<td>{{ $per->num_documento }}</td>
				<td>{{ $per->telefono }}</td>							
				<td>{{ $per->email }}</td>							
			</tr>						
		@endforeach				
	</table>
	
</body>
</html>
