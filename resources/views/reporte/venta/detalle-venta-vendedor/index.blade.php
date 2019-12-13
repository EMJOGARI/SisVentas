@extends ('layouts.admin')
@section('name', "Detalle Vendedor")
@section('content')

<div class="row" style="margin-bottom: 2rem;">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="row">
			@include('reporte.venta.detalle-venta-vendedor.search')
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		@foreach ($vendedor as $ven)
		<div class="box-header with-border">
	        <h3 class="box-title"><strong>{{ $ven->nombre }}</strong></h3>
        </div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="5%">Codigo</th>
						<th width="35%">Nombre</th>
						<th width="10%">Categoría</th>
						<th width="10%">Cantidad Vendida</th>
					</thead>
					@foreach ($art_ventas as $art)
						@if( $art->idvendedor == $ven->idpersona )
							<tr>
								<td align="center">{{ str_pad($art->idarticulo, 3, "0", STR_PAD_LEFT) }}</td>
								<td>{{ $art->nombre }}</td>
								<td align="center">{{ $art->categoria }}</td>
								<td align="center">{{ $art->cantidad }}</td>
							</tr>
						@endif
					@endforeach
				</table>
			</div>
			{{ $vendedor->appends(Request::all())->render() }}
		@endforeach

			
	</div>
</div>

@endsection