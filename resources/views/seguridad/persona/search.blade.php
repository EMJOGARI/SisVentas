{!! Form::open(array('url'=>'seguridad/persona', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchCodigo" placeholder="Buscar ID Persona" value="{{ $searchCodigo }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>		
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{ $searchText }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>		
	</div>
</div>	
{{ Form::close() }}