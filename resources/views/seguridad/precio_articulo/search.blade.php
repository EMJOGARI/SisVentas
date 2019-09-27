{!! Form::open(array('url'=>'seguridad/precio_articulo', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar por Nombre" value="{{ $searchText }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchCodigo" placeholder="Buscar Nº Codigo" value="{{ $searchCodigo }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>				
				</span>
			</div>		
		</div>
	</div>
	
{{ Form::close() }}