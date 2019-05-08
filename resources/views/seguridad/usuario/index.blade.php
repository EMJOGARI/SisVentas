@extends ('layouts.admin')
@section('name', "Lista de Usuarios")
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">			
			@include('seguridad.usuario.search')			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Id</th>
						<th>Nombre</th>
						<th>Email</th>
						<th>Usuario</th>
					</thead>
					@foreach ($usuarios as $usu)
						<tr>
							
							<td align="center">{{ $usu->id }}</td>
							<td>{{ $usu->name }}</td>
							<td>{{ $usu->email }}</td>
							<td>{{ $usu->description }}</td>							
						</tr>
						@include('seguridad.usuario.modal')
					@endforeach
				</table>
			</div>
			{{ $usuarios->render() }}	
		</div>
	</div>
@endsection