<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th width="30%"></th>
			<th width="10%"></th>
		</thead>
			<tr>
				<td><strong>CLIENTES A ACTIVAR</strong></td>
				<td align="right">{{ number_format( $var_vendedor->cuota_cliente_activar, 0, ',', '.') }}</td>
			</tr>
			<tr>
				<td><strong>CLIENTES ACTIVADOS</strong></td>
				<td align="right">{{ number_format( $num_clientes->clientes , 0, ',', '.') }}</td>
			</tr>
			<tr>
				<td><strong>% CLIENTES</strong></td>
				<td align="right">{{ number_format((($num_clientes->clientes/$var_vendedor->cuota_cliente_activar))*100, 2, ',', '.') }} <strong>%</strong></td>
			</tr>
			<tr>
				<td><strong>INCENTIVO</strong></td>
				<td align="right">{{ number_format( $var_vendedor->incentivo_cliente_activar * ((($num_clientes->clientes/$var_vendedor->cuota_cliente_activar))), 2, ',', '.') }}</td>
			</tr>
	</table>
</div>
