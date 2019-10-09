@extends ('layouts.admin')
@section('name', "Resumen de Articulos por Categorias")
@section('content')

<div class="row">
	<div class="col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="5%">ID</th>
					<th width="50%">Categoria</th>
					<th width="5%">Stock</th>
				</thead>
			@foreach ($articulos as $art)
				<tr>
					<td>{{ $art->idcategoria}}</td>
					<td>{{ $art->nombre }}</td>
					<td align="center"><strong>{{ $art->stock }}</strong></td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td align="center"><strong>TOTAL:</strong></td>
					<td align="center"><strong>{{ $sum_stock }}</strong></td>
				</tr>
			</table>
		</div>
	</div>
</div>
@endsection