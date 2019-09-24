{!! Form::open(array('url'=>'cobranza/cuenta-por-cobrar', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="input-group">
        <select name="searchVendedor" id="searchVendedor" class="form-control selectpicker" data-live-search="true">
            <option value="">Seleccioné un Vendedor</option>
              @foreach($vendedores as $persona)
                <option value="{{ $persona->idpersona }}">{{ str_pad($persona->idpersona, 3, "0", STR_PAD_LEFT).' - '.$persona->nombre }}</option>
              @endforeach
            </select>
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar Nº Factura..." value="{{ $searchText }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>
	</div>
{{ Form::close() }}