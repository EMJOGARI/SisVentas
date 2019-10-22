{!! Form::open(array('url'=>'reporte/compra/compra-proveedor', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
            <input type="text" id="FechaInicio" name="FechaInicio" class="form-control pull-right" data-date-end-date="0d">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
            <input type="text" id="FechaFinal" name="FechaFinal" class="form-control pull-right" data-date-end-date="0d">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
        <select name="searchProveedor" id="searchProveedor" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccioné un Proveedor</option>
            @foreach($proveedor as $persona)
                <option value="{{ $persona->idpersona }}">{{ str_pad($persona->idpersona, 3, "0", STR_PAD_LEFT).' - '.$persona->nombre }}</option>
            @endforeach
        </select>
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
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
        <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</div>
 {{ Form::close() }}