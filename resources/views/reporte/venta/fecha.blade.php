{!! Form::open(array('url'=>'reporte/venta', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
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
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
      </span>
  </div>
 {{ Form::close() }}