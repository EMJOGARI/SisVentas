@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Personas <a href="{{ url('seguridad/persona/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>

				<div class="btn-group">
				    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				    	Reporte de Personas <span class="caret"></span>
				    </button>

				    <ul class="dropdown-menu" role="menu">
					    <li><a href="{{ url('pdf/reportepersona') }}" target="_blank">Todos</a></li>
					    <li><a href="{{ url('pdf/reportecliente') }}" target="_blank">Clientes</a></li>
					    <li><a href="{{ url('pdf/reporteproveedor') }}" target="_blank">Proveedores</a></li>					    
					    <li><a href="{{ url('pdf/reportevendedor') }}" target="_blank">Vendedores</a></li>
				    </ul>
				</div>				
			</h3>
			@include('seguridad.persona.search')			
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
						<th>Tipo Persona</th>
						<th>Opcions</th>
					</thead>
					@foreach ($personas as $per)
						<tr>												
							<td>{{ $per->idpersona }}</td>
							<td>{{ $per->nombre }}</td>
							<td>{{ $per->tipo_documento }}</td>
							<td>{{ $per->num_documento }}</td>
							<td>{{ $per->telefono }}</td>
							<td>{{ $per->tipo_persona }}</td>
							<td>
								<a href="{{ URL::action('PersonaController@edit',$per->idpersona) }}"><button class="btn btn-primary"><i class="fa fa-file-text-o"></i> Editar</button></a> 
								<a href="{{ URL::action('PersonaController@destroy',$per->idpersona) }}" data-target="#modal-delete-{{ $per->idpersona }}" data-toggle="modal"> <button class="btn btn-danger"><i class="fa fa-close"></i> Eliminar</button></a>
							</td>
						</tr>
						@include('seguridad.persona.modal')
					@endforeach
				</table>
			</div>
			{{ $personas->render() }}	
		</div>
	</div>
@endsection