@extends ('pdf.reporte')

@section('title', "Listado de Clientes")

@section('content')
	<h2>Listado de Clientes</h2>
	<table>
		<tr style="background-color: #dddddd;">
			<th>Id</th>
			<th>Nombre</th>
			<th>Tipo Doc.</th>
			<th>Numero Doc.</th>
			<th>Telefono</th>
			<th>Tipo Persona</th>
		</tr>		
		@foreach ($personas as $per)
			<tr>												
				<td>{{ $per->idpersona }}</td>
				<td>{{ $per->nombre }}</td>
				<td>{{ $per->tipo_documento }}</td>
				<td>{{ $per->num_documento }}</td>
				<td>{{ $per->telefono }}</td>
				<td>{{ $per->tipo_persona }}</td>							
			</tr>						
		@endforeach				
	</table>		
@endsection
