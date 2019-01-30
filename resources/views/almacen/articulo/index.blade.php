@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-primary">Nuevo Articulo</button> <a href="{{ url('pdf/reporte') }}" target="_blank"><button class="btn btn-success">Reporte de Articulos</button></a></h3>
			@include('almacen.articulo.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Codigo</th>
						<th>Categoría</th>
						<th>Stock</th>
						<th>Precio Venta</th>
						<th>Estado</th>
						<th>Opcions</th>
					</thead>
					@foreach ($articulos as $art)
						<tr>												
							<td>{{ $art->idarticulo }}</td>
							<td>{{ $art->nombre }}</td>
							<td>{{ $art->codigo }}</td>
							<td>{{ $art->categoria }}</td>
							<td>{{ $art->stock }}</td>	
							<td>{{ $art->costo }}</td>						
							<td>{{ $art->estado }}</td>
							<td>
								<a href="{{ URL::action('ArticuloController@edit',$art->idarticulo) }}"><button class="btn btn-info">Editar</button></a> 
								<a href="{{ URL::action('ArticuloController@destroy',$art->idarticulo) }}" data-target="#modal-delete-{{ $art->idarticulo }}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
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