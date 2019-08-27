{!! Form::open(array('url'=>'reporte/almacen', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="input-group">
		<select name="searchList" class="form-control">
			<option value="1" selected>Productos en Existencia</option>
			<option value="2">Productos sin Existencia</option>
		</select>
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
{{ Form::close() }}
