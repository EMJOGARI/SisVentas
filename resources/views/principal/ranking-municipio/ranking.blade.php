<div class="box box-primary">
  <div class="box-header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h3 class="box-title"><strong>Ranking Municipios</strong></h3>
      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
          <tr>
            <th width="10%">#</th>
            <th width="70%">Municippio</th>
            <th width="20%">Acumulado</th>
          </tr>
          @foreach ($ranking_municipio as $rank)
              <tr>
                <td align="center"><strong>{{$k = $k + 1}}</strong></td>
                <td>{{ $rank->municipio }}</td>
                <td align="right">{{ number_format($rank->total, 2, ',', '.') }}</td>
              </tr>
          @endforeach
          <tr>
            <td></td>
            <td align="center"><strong>TOTAL:</strong></td>
            <td align="right"><strong>{{ number_format($sum_total, 2, ',', '.') }}</strong></td>
          </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>