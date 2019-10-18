@extends ('layouts.admin')
@section('name', "Productos Mas vendidos")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.almacen.producto-mas-vendido.search')
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="5%">Codigo</th>
					<th width="35%">Nombre</th>
					<th width="10%">Categoría</th>
					<th width="10%">Cantidad Vendida</th>
				</thead>
				@foreach ($art_ventas as $art)
					<tr>
						<td align="center">{{ str_pad($art->idarticulo, 3, "0", STR_PAD_LEFT) }}</td>
						<td>{{ $art->nombre }}</td>
						<td align="center">{{ $art->categoria }}</td>
						<td align="center">{{ $art->cantidad }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{ $art_ventas->appends(Request::all())->render() }}
	</div>
</div>

@endsection