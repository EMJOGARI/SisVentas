@extends ('layouts.admin')
@section('name', "Ranking Clientes")
@section('content')
	<div class="row">
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			{{--@include('reporte.almacen.listado-producto.search')--}}
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
			<a href="#"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir Reporte</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">						
				<table class="table table-striped table-bordered table-condensed table-hover">
					<tbody>
				          <tr>
				            <th width="5%">#</th>
				            <th width="30%">Nombre</th>
				            <th width="20%">Vendedor</th>
				            <th width="10%">Fact. Pagadas</th>
				            <th width="10%">Fact. Pendientes</th>
				            <th width="10%">Fact. Neta</th>

				          </tr>
				          @foreach ($ranking as $rank)
				              <tr>
				                <td align="center"><strong>{{$k = $k + 1}}</strong></td>
				                <td>{{ $rank->nombre }}</td>
				                <td></td>
				                <td align="right">{{ number_format($rank->pagadas, 2, ',', '.') }}</td>
				                <td align="right">{{ number_format($rank->pendientes, 2, ',', '.') }}</td>
				                <td align="right">{{ number_format($rank->total, 2, ',', '.') }}</td>
				              </tr>
				          @endforeach
				          <tr>
				            <td></td>
				            <td></td>
				            <td align="center"><strong>TOTAL:</strong></td>
				            <td align="right"><strong>{{ number_format($sum_total_c, 2, ',', '.') }}</strong></td>
				            <td align="right"><strong>{{ number_format($sum_total_p, 2, ',', '.') }}</strong></td>				            
				            <td align="right"><strong>{{ number_format($sum_total, 2, ',', '.') }}</strong></td>
				          </tr>
				    </tbody>
				</table>			
			</div>
			{{-- $articulos->appends(Request::all())->render() --}}
		</div>
	</div>
@endsection