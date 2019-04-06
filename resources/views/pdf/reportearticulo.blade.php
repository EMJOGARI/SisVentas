@extends ('pdf.reporte')

@section('title', "Reporte de Articulos")

@section('content')
	<h2>Reporte de Articulos</h2>
		<table width="100%">
			<tr style="background-color: #dddddd;">
				<th width="5%">ID</th>
				<th width="50%">Nombre</th>
				<th width="10%">Codigo</th>
				<th width="15%">Categoria</th>
				<th width="10%">Stock</th>
				<th width="10%">Estado</th>
			</tr>		
			@foreach ($articulos as $art)
				<tr>												
					<td style="text-align: center;">{{ $art->idarticulo }}</td>
					<td>{{ $art->nombre }}</td>
					<td style="text-align: center;">{{ $art->codigo }}</td>
					<td style="text-align: center;">{{ $art->categoria }}</td>
					<td style="text-align: center;">{{ $art->stock }}</td>					
					<td style="text-align: center;">{{ $art->estado }}</td>							
				</tr>				
			@endforeach				
		</table>	
@endsection


				
