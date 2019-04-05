@extends ('pdf.reporte')

@section('title', "Reporte de Articulos")

@section('content')
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
@endsection


				
