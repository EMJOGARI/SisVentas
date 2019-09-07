{!! Form::open(array('url'=>'reporte/venta', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="form-group">
		<select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true">
        	<option value="">Seleccioné un Cliente</option>
        	@foreach($clientes as $persona)
        		<option value="{{ $persona->idpersona }}">{{ str_pad($persona->idpersona, 3, "0", STR_PAD_LEFT).' - '.$persona->nombre }}</option>
        	@endforeach
        </select>
	</div>
{{ Form::close() }}
