@extends ('layouts.admin')
@section('name', "Ranking Clientes")
@section('content')
	<div class="row">
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			@include('reporte.ranking.cliente.search'){{----}}
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
			<a href="#"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir Reporte</button></a>
		</div>
	</div>
<br>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<tbody>
				          	<tr>
					            <th width="5%">#</th>
					            <th width="40%">Nombre</th>
					            <th width="25%">Vendedor</th>
					            <th width="10%">Fact. Neta</th>
				          	</tr>
				        @foreach ($ranking as $rank)
				              <tr>
					                <td align="center"><strong>{{$k = $k + 1}}</strong></td>
					                <td>{{ str_pad($rank->idcliente, 3, "0", STR_PAD_LEFT).' - '.$rank->nombre }}</td>
					                <td>{{ str_pad($rank->idvendedor, 3, "0", STR_PAD_LEFT) }}</td>
					                <td align="right">{{ number_format($rank->total - $rank->noce, 2, ',', '.') }}</td>
				              </tr>
				        @endforeach
					          <tr>
						            <td></td>
						            <td></td>
						            <td align="center"><strong>TOTAL:</strong></td>
						            <td align="right"><strong>{{ number_format($sum_total, 2, ',', '.') }}</strong></td>
					          </tr>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
@endsection