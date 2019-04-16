@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cambiar Precios de Articulos								
			</h3>
			@include('seguridad.precio_articulo.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Codigo</th>
						<th width="55%">Nombre</th>
						<th width="5%">Stock</th>
						<th width="15%">Precio de Venta</th>
						<th width="20%">Opcions</th>
					</thead>
					@foreach ($articulos as $art)
						<tr>
							<td style="text-align: center;">{{ $art->codigo }}</td>
							<td>{{ $art->nombre }}</td>
							<td style="text-align: center;">{{ $art->stock }}</td>
							<td style="text-align: right;">{{ number_format($art->precio_venta, 2, ',', '.') }}</td>
							<td>
								<a href="{{ URL::action('EditPrecioController@edit',$art->idarticulo) }}"><button class="btn btn-primary"><i class="fa fa-file-text-o"></i> Editar</button></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{ $articulos->render() }}	
		</div>
	</div>
@endsection