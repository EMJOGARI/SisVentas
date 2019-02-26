@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Editar Persona: {{ $persona->nombre }}</h3>

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($persona,['method'=>'PUT', 'route'=>['persona.update',$persona->idpersona]]) !!}
			{{ Form::token() }}
				<div class="row">	            
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>"{{ $persona->nombre }}"]) !!}
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('tipo_documento', 'Tipo Documento') !!}
	                    <select name="tipo_documento" class="form-control">
	                    	@if($persona->tipo_documento=='C')
	                    		<option value="C" selected>Cedula de Identidad</option>
		                    	<option value="R">RIF</option>
		                    	<option value="P">Pasaporte</option>
	                    	@elseif($persona->tipo_documento=='R')
	                    		<option value="C">Cedula de Identidad</option>
		                    	<option value="R" selected>RIF</option>
		                    	<option value="P">Pasaporte</option>
	                    	@else
	                    		<option value="C">Cedula de Identidad</option>
		                    	<option value="R">RIF</option>
		                    	<option value="P" selected>Pasaporte</option>
	                    	@endif	                    	                   	
	                    </select>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('num_documento', 'Numero de Documento') !!}
	                    {!! Form::text('num_documento', null, ['class'=>'form-control', 'value'=>"{{ $persona->num_documento }}"]) !!}
	                </div>
	            </div>
	           
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('telefono', 'Nro. Telefonico') !!}
	                    {!! Form::text('telefono', null, ['class'=>'form-control', 'value'=>"{{ $persona->telefono }}"]) !!}
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('email', 'Email') !!}
	                    {!! Form::text('email', null, ['class'=>'form-control', 'value'=>"{{ $persona->email }}"]) !!}
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('tipo_persona', 'Tipo Persona') !!}
	                    <select name="tipo_persona" class="form-control">
	                    	@if($persona->tipo_persona=='Proveedor')
	                    		<option value="Proveedor" selected>Proveedor</option>
		                    	<option value="Cliente">Cliente</option>
		                    	<option value="Vendedor">Vendedor</option>
	                    	@elseif($persona->tipo_persona=='Cliente')
	                    		<option value="Proveedor">Proveedor</option>
		                    	<option value="Cliente" selected>Cliente</option>
		                    	<option value="Vendedor">Vendedor</option>
	                    	@else
	                    		<option value="Proveedor">Proveedor</option>
		                    	<option value="Cliente">Cliente</option>
		                    	<option value="Vendedor" selected>Vendedor</option>
		                    @endif
	                    		                    	
	                    </select>
	                </div>
	            </div>
	             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('direccion', 'Direccion') !!}
	                    {!! Form::text('direccion', null, ['class'=>'form-control', 'value'=>"{{ $persona->direccion }}"]) !!}
	                </div>
	            </div>
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="form-group">
	                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                	<button class="btn btn-danger" onclick="history.back()" type="reset"><i class="fa fa-close"></i> Cancelar</button>
	                </div>
	            </div>
	            
			</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection