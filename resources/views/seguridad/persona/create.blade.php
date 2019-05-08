@extends ('layouts.admin')
@section('name', "Nueva Persona")
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
			
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('url'=>'seguridad/persona', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{ Form::token() }}
			<div class="row">
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>"{{ old('nombre') }}", 'placeholder'=>'Nombre...']) !!}
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('tipo_documento', 'Tipo Documento') !!}
	                    <select name="tipo_documento" class="form-control"> 
	                    	<option value="V">V-VENEZOLANO</option>
	                    	<option value="J">J-JURIDICO</option>	                    	
	                    </select>
	                </div>	                
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('num_documento', 'Nro. de Doc.') !!}
	                    {!! Form::text('num_documento', null, ['class'=>'form-control', 'value'=>"{{ old('num_documento') }}", 'placeholder'=>'Numero de Documento...']) !!}
	                </div>
	            </div>
	            
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('telefono', 'Nro. Telefonico') !!}
	                    {!! Form::text('telefono', null, ['class'=>'form-control', 'value'=>"{{ old('telefono') }}", 'placeholder'=>'Nro de Telefono...']) !!}
	                </div>
	            </div>
	           
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('tipo_persona', 'Tipo Persona') !!}
	                    <select name="tipo_persona" class="form-control"> 
	                    	<option value="Proveedor">Proveedor</option>
	                    	<option value="Cliente">Cliente</option>
	                    	<option value="Vendedor">Vendedor</option>	                    	
	                    </select>
	                </div>
	            </div>


	            
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('direccion', 'Direccion') !!}
	                    {!! Form::text('direccion', null, ['class'=>'form-control', 'value'=>"{{ old('direccion') }}", 'placeholder'=>'Direccion...']) !!}
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