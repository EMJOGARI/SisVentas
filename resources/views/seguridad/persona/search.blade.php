{!! Form::open(array('url'=>'seguridad/persona', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="input-group">
			<select name="searchPersona" class="form-control">
				<option value="" selected>Seleccioné...</option>
				@foreach ($tipos as $tip)
				<option value="{{ $tip->tipo_persona}}">{{ $tip->tipo_persona}}</option>
				@endforeach
			</select>
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchCodigo" placeholder="Buscar ID Persona">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>		
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar...">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>		
	</div>
</div>	
{{ Form::close() }}