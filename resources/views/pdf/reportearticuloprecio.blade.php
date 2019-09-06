@extends ('pdf.reporte')

@section('title', "Reporte de Articulos")

@section('content')
	<h2>Listado de Precio</h2>
		<table width="100%">
			<tr style="background-color: #dddddd;">
				<th style="text-align: center;" width="5%">Codigo</th>
				<th width="35%">Nombre</th>
				<th width="15%">Categoria</th>
				<th style="text-align: center;" width="5%">Stock</th>
				<th width="15%">Precio de Venta</th>
			</tr>
			@foreach ($articulos as $art)
				<tr>
					<td style="text-align: center;">{{ $art->codigo }}</td>
					<td>{{ $art->nombre }}</td>
					<td>{{ $art->categoria }}</td>
					<td style="text-align: center;">{{ $art->stock }}</td>
					<td style="text-align: right;">{{ number_format($art->precio_venta, 2, ',', '.') }}</td>
				</tr>
			@endforeach
		</table>
@endsection



