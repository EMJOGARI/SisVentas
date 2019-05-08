@extends ('layouts.admin')
@section('name', "Listado de Categoria")
@section('content')
	<div class="row">		
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">			
			<a href="{{ url('almacen/categoria/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Categoria</button></a>
		</div>
		<div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-lg-5 col-md-5 col-sm-5 col-xs-12">			
			@include('almacen.categoria.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Id</th>
						<th width="65%">Nombre</th>
						<th width="30%">Opcions</th>
					</thead>
					@foreach ($categorias as $cat)
						<tr>
							
							<td align="center">{{ $cat->idcategoria }}</td>
							<td>{{ $cat->nombre }}</td>
							<td>
								<a href="{{ URL::action('CategoriaController@edit',$cat->idcategoria) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> Editar</button></a> 
								<a href="{{ URL::action('CategoriaController@destroy',$cat->idcategoria) }}" data-target="#modal-delete-{{ $cat->idcategoria }}" data-toggle="modal"> <button class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.categoria.modal')
					@endforeach
				</table>
			</div>
			{{ $categorias->render() }}	
		</div>
	</div>
@endsection