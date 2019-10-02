{!! Form::open(array('url'=>'reporte/almacen/listado-producto', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="input-group">
			<select name="searchList" class="form-control">
				<option value="" selected>Seleccioné un metodo</option>
				<option value="1">Productos en Existencia</option>
				<option value="2">Productos sin Existencia</option>
			</select>
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="input-group">
		    <select name="searchCategoria" class="form-control" name="reload_categoria" id="reload_categoria">
		    	<option value="">Selecciona una Categoria</option>
		    	@foreach ($categorias as $cat)
		    		<option value="{{ $cat->idcategoria }}">{{ $cat->nombre }}</option>
				@endforeach
		    </select>
		    <span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar por código..." value="{{ $searchText }}">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
				</span>
			</div>			
		</div>
	</div>		
</div>
{{ Form::close() }}