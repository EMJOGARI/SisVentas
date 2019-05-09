@extends ('layouts.admin')
@section('name', "Lista de Personas")
@section('content')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<a href="{{ url('seguridad/persona/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>		
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
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">			
			@include('seguridad.persona.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Id</th>
						<th width="35%">Nombre</th>
						<th width="10%">Numero Doc.</th>
						<th width="10%">Telefono</th>
						<th width="10%">Tipo Persona</th>
						<th width="20%">Opcions</th>
					</thead>
					@foreach ($personas as $per)
						<tr>												
							<td align="center">{{ str_pad($per->idpersona, 3, "0", STR_PAD_LEFT) }}</td>
							<td>{{ $per->nombre }}</td>
							<td align="center">{{ $per->tipo_documento.'-'.$per->num_documento }}</td>
							<td align="center">{{ $per->telefono }}</td>
							<td align="center">{{ $per->tipo_persona }}</td>
							<td align="center">
								<a href="{{ URL::action('PersonaController@edit',$per->idpersona) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> Editar</button></a> 
								<a href="{{ URL::action('PersonaController@destroy',$per->idpersona) }}" data-target="#modal-delete-{{ $per->idpersona }}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a>
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