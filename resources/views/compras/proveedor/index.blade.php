@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Proveedor <a href="proveedor/create"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>
				<a href="{{ url('pdf/reporteproveedor') }}" target="_blank">
					<button class="btn btn-success"><i class="fa fa-print"></i> Lista de Proveedores</button>
				</a>
			</h3>
			@include('compras.proveedor.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Tipo Doc.</th>
						<th>Numero Doc.</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Opcions</th>
					</thead>
					@foreach ($personas as $per)
						<tr>												
							<td>{{ $per->idpersona }}</td>
							<td>{{ $per->nombre }}</td>
							<td>{{ $per->tipo_documento }}</td>
							<td>{{ $per->num_documento }}</td>
							<td>{{ $per->telefono }}</td>							
							<td>{{ $per->email }}</td>
							<td>
								<a href="{{ URL::action('ProveedorController@edit',$per->idpersona) }}"><button class="btn btn-primary"><i class="fa fa-file-text-o"></i> Editar</button></a> 
								<a href="{{ URL::action('ProveedorController@destroy',$per->idpersona) }}" data-target="#modal-delete-{{ $per->idpersona }}" data-toggle="modal"> <button class="btn btn-danger"><i class="fa fa-close"></i> Eliminar</button></a>
							</td>
						</tr>
						@include('compras.proveedor.modal')
					@endforeach
				</table>
			</div>
			{{ $personas->render() }}	
		</div>
	</div>
@endsection