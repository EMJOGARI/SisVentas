<!DOCTYPE html>
<html lang="en">
 <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">   
<head>
	<meta charset="UTF-8">
	<title>Reporte de Articulos</title>
	<style>
		img{
			width: 30%;
		}
		h2{
			text-align: : center;
		}
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
	
	<img src="{{ url('/assets/img/ferrevive.png') }}" alt="FERREVIVE C.A.">

	{{ date('d/m/Y') }}
			
	<h2>Reporte de Articulos</h2>
	<table>
		<tr style="background-color: #dddddd;">
			<th>ID</th>
			<th>Nombre</th>
			<th>Codigo</th>
			<th>Categoria</th>
			<th>Stock</th>
			<th>Estado</th>
		</tr>		
		@foreach ($articulos as $art)
			<tr>												
				<td>{{ $art->idarticulo }}</td>
				<td>{{ $art->nombre }}</td>
				<td>{{ $art->codigo }}</td>
				<td>{{ $art->categoria }}</td>
				<td>{{ $art->stock }}</td>					
				<td>{{ $art->estado }}</td>							
			</tr>				
		@endforeach				
	</table>
	



	<!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
</body>
</html>