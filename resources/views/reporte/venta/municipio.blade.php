{!! Form::open(array('url'=>'reporte/venta', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="form-group">
		<select name="municipio" id="municipio" class="form-control selectpicker" data-live-search="true">
                	<option value="">Seleccioné un Municipio</option>
                	<option value="Arismendi">Arismendi</option>
                	<option value="Antolin del Campo">Antolin del Campo</option>
                	<option value="Díaz">Díaz</option>
                	<option value="García">García</option>
                	<option value="Gómez">Gómez</option>
                	<option value="Maneiro">Maneiro</option>
                	<option value="Marcano">Marcano</option>
                	<option value="Mariño">Mariño</option>
                	<option value="Península de Macanao">Península de Macanao</option>
                	<option value="Tubares">Tubares</option>
                	<option value="Villalba">Villalba</option>
                </select>
	</div>
{{ Form::close() }}
