<div class="box">
            <div class="box-header">
              <h3 class="box-title"><strong>Ranking Top 10 Clientes</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody>
                    <tr>
                      <th width="10%">#</th>
                      <th width="70%">Nombre</th>
                      <th width="20%">Acumulado</th>
                    </tr>                    
                    @foreach ($ranking as $rank)
                        <tr>                        
                          <td><strong>{{$k = $k + 1}}</strong></td>
                          <td>{{ $rank->nombre }}</td>
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
            {{ $ranking->appends(Request::all())->render() }}
            <!-- /.box-body -->
          </div>