@extends ('layouts.admin')
@section('name', "Reportes de Ventas por Categorias")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.venta.venta-categoria.search')
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
		<a href="#"><button class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button></a>
	</div>
</div>

<div class="row">
	<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="50%">Vendedor</th>
					<th width="15%">Categoria</th>
					<th width="5%">Cantidad</th>
					<th width="10%">Neto</th>
					<th width="5%"></th>
				</thead>
					@foreach ($ventas as $ven)
						<tr>
							<td>{{ $ven->vendedor }}</td>
							<td>{{ $ven->categorias }}</td>
							<td align="center">{{ $ven->cantidad }}</td>
							<td align="right">{{ number_format($ven->neto, 2, ',', '.') }}</td>
							<td>
								<a href="#" data-target="#modal-show-{{ $ven->idvendedor }}" data-toggle="modal">
									<button class="btn btn-default">
										<i class="fa fa-fw fa-eye"></i>
									</button>
								</a>
							</td>
						</tr>
						@include('reporte.venta.venta-categoria.modal')
					@endforeach
						<tr>
							<td></td>
							<td align="center"><strong>TOTAL:</strong></td>
							<td align="right"><strong>{{ $sum_total }}</strong></td>
							<td align="right"><strong>{{ number_format($sum_neto, 2, ',', '.') }}</strong></td>
						</tr>
			</table>
		</div>
		{{-- $ventas->render() --}}
	</div>
</div>
@endsection