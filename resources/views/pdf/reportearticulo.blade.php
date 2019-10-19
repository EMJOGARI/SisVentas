@extends ('pdf.reporte')

@section('title', "Reporte de Articulos")

@section('content')
	<h2>Reporte de Articulos</h2>
	@foreach($categorias as $cat)
		<h3><strong>{{ $cat->nombre }}</strong></h3>
		<table width="100%">
			<tr style="background-color: #dddddd;">
				<th width="10%">Codigo</th>
				<th width="80%">Nombre</th>
				<th width="10%">Stock</th>
			</tr>
			@foreach ($articulos as $art)
				@if(($cat->nombre)==($art->categoria))
					<tr>
						<td style="text-align: center;">{{ str_pad($art->idarticulo, 3, "0", STR_PAD_LEFT) }}</td>
						<td>{{ $art->nombre }}</td>
						<td style="text-align: center;"></td>
					</tr>
				@endif
			@endforeach
		</table>
		<br>
	@endforeach
@endsection



