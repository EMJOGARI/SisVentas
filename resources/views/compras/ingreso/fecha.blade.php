{{--
{!! Form::open(array('url'=>'compras/ingreso', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" id="date_range" name="date_range" class="form-control pull-right">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary"  name="submitRangeDates"><i class="fa fa-search"></i> Enviar</button>
        </span>
    </div>
{{ Form::close() }}
--}}
{!! Form::open(array('url'=>'compras/ingreso', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search' )) !!}
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
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Enviar</button>
      </span>
  </div>
 {{ Form::close() }}
