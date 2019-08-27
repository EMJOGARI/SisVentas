@extends ('layouts.admin')
@section('name', "Listado de Articulos")
@section('content')
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<a href="{{ url('almacen/articulo/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Articulo</button></a>
		</div>
		<div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-lg-5 col-md-5 col-sm-5 col-xs-12">
			@include('almacen.articulo.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Codigo</th>
						<th width="40%">Producto</th>
						<th width="10%">Categoría</th>
						<th width="5%">Estado</th>
						<th width="5%">Stock</th>
						<th width="10%">Precio Venta</th>
						<th width="10%"></th>
					</thead>
					@foreach ($articulos as $art)
						<tr>
							<td align="center">{{ $art->codigo }}</td>
							<td>{{ $art->nombre }}</td>
							<td align="center">{{ $art->categoria }}</td>
							<td align="center">
								<span class="label label-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $art->estado }}</font></font></span>
							</td>
							<td align="center">{{ $art->stock }}</td>
							<td align="right">{{ number_format($art->precio_venta, 2, ',', '.') }}</td>
							<td align="center">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::action('ArticuloController@edit',$art->idarticulo) }}"><i class="fa fa-edit"></i> Editar</a></li>
										<li><a href="{{ URL::action('ArticuloController@destroy',$art->idarticulo) }}" data-target="#modal-delete-{{ $art->idarticulo }}" data-toggle="modal"><i class="fa fa-trash"></i> Eliminar</a></li>
									</ul>
								</div>
							</td>
						</tr>
						@include('almacen.articulo.modal')
					@endforeach
				</table>
			</div>
			{{ $articulos->render() }}
		</div>
	</div>
@endsection