@extends ('layouts.admin')
@section('name', "Resumen de Articulos por Categorias")
@section('content')

<div class="row">
	<div class="col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="5%">ID</th>
					<th width="50%">Categoria</th>
					<th width="5%">Stock</th>
					<th width="20%">Neto</th>
				</thead>
			@foreach ($articulos as $art)
				<tr>
					<td>{{ $art->idcategoria}}</td>
					<td>{{ $art->nombre }}</td>
					<td align="center"><strong>{{ $art->stock }}</strong></td>
					<td align="right">
						<strong>
							@switch($art->idcategoria)
							    @case(2)
							        {{ number_format($sum_cat_2, 2, ',', '.') }}
							        @break
							    @case(3)
							        {{ number_format($sum_cat_3, 2, ',', '.') }}
							        @break
							    @case(4)
							        {{ number_format($sum_cat_4, 2, ',', '.') }}
							        @break
							    @case(5)
							        {{ number_format($sum_cat_5, 2, ',', '.') }}
							        @break
							    @case(6)
							        {{ number_format($sum_cat_6, 2, ',', '.') }}
							        @break
							    @case(7)
							        {{ number_format($sum_cat_7, 2, ',', '.') }}
							        @break
							    @case(8)
							        {{ number_format($sum_cat_8, 2, ',', '.') }}
							        @break
							    @case(10)
							        {{ number_format($sum_cat_10, 2, ',', '.') }}
							        @break
							    @case(11)
							        {{ number_format($sum_cat_11, 2, ',', '.') }}
							        @break
							@endswitch
						</strong>
					</td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td align="center"><strong>TOTAL:</strong></td>
					<td align="center"><strong>{{ $sum_stock }}</strong></td>
					<td align="right"><strong>{{ number_format($total_catgoria, 2, ',', '.') }}</strong></td>
				</tr>
			</table>
		</div>
	</div>
</div>
@endsection