{!! Form::open(array('url'=>'reporte/almacen/margen-utilidad', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
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
{{ Form::close() }}