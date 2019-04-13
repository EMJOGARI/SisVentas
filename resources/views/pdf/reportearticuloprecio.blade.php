@extends ('pdf.reporte')

@section('title', "Reporte de Articulos")

@section('content')
	<h2>Listado de Precio</h2>
		<table width="100%">
			<tr style="background-color: #dddddd;">
				<th width="10%">Codigo</th>
				<th width="50%">Nombre</th>
				<th width="10%">Stock</th>
				<th width="10%">Precio</th>
			</tr>		
			@foreach ($articulos as $art)
				<tr>
					<td style="text-align: center;">{{ $art->codigo }}</td>
					<td>{{ $art->nombre }}</td>					
					<td style="text-align: center;">{{ $art->stock }}</td>					
					<td style="text-align: right;">{{ $art->precio_venta }}</td>							
				</tr>				
			@endforeach				
		</table>	
@endsection


				
