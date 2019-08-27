<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			@include('reporte.venta.search')
		</div>
		<div class="col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<a href="{{ url('pdf/reportearticuloprecio') }}"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir Reporte</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Codigo</th>
						<th width="35%">Nombre</th>
						<th width="10%">Categoría</th>
						<th width="5%">Stock</th>
						<th width="10%">Costo</th>
						<th width="10%">Precio Venta</th>
						<th width="10%">Utilidad</th>
					</thead>
					@foreach ($articulos as $art)
						<tr>
							<td align="center">{{ $art->codigo }}</td>
							<td>{{ $art->nombre }}</td>
							<td align="center">{{ $art->categoria }}</td>
							<td align="center">{{ $art->stock }}</td>
							<td align="right">{{ number_format($art->precio_compra, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($art->precio_venta, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($art->precio_venta - $art->precio_compra, 2, ',', '.') }}</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{ $articulos->render() }}
		</div>
	</div>