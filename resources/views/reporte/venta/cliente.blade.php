{!! Form::open(array('url'=>'reporte/venta', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="input-group">
		<select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true">
        	<option value="">Seleccioné un Cliente</option>
        	@foreach($clientes as $persona)
        		<option value="{{ $persona->idpersona }}">{{ str_pad($persona->idpersona, 3, "0", STR_PAD_LEFT).' - '.$persona->nombre }}</option>
        	@endforeach
        </select>
        <span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
{{ Form::close() }}
