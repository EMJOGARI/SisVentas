@extends ('layouts.admin')
@section('name', "Variables Vendedores")
@section('content')
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
			<a href="{{ url('seguridad/variable_vendedor/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>
		</div>
	</div>
<br/>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th width="10%">Fecha</th>
						<th width="16%">Vendedor</th>
						<th width="16%">Cuota de Venta</th>
						<th width="16%">Incentivo de Venta</th>
						<th width="16%">Clientes a Activar</th>
						<th width="16%">Incentivo de Activación</th>
						<th width="10%"></th>
					</thead>
					@foreach ($variable as $var)
						<tr>
							<td align="center">{{ date('d-m-Y', strtotime($var->fecha)) }}</td>
							<td>{{ $var->idvendedor }}</td>
							<td align="right">{{ number_format($var->cuota_venta, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($var->incentivo_venta, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($var->cuota_cliente_activar, 0, ',', '.') }}</td>
							<td align="right">{{ number_format($var->incentivo_cliente_activar, 2, ',', '.') }}</td>
							<td>{{--
								<a href="{{ URL::action('VariablevendedorController@edit',$var->idvar) }}"><button class="btn btn-default"><i class="fa fa-edit"></i> Editar</button></a>--}}
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>

	</div>
@endsection