<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th width="30%"></th>
			<th width="10%"></th>
		</thead>
			<tr>
				<td><strong>CUOTA DE VENTAS</strong></td>
				<td align="right">{{ number_format( $var_vendedor->cuota_venta, 2, ',', '.') }}</td>
			</tr>
			<tr>
				<td><strong>VENTA ALCANZADA</strong></td>
				<td align="right">{{ number_format( $venta_vendedor->venta_total , 2, ',', '.') }}</td>
			</tr>
			<tr>
				<td><strong>% META</strong></td>
				<td align="right">{{ number_format((($venta_vendedor->venta_total/$var_vendedor->cuota_venta))*100, 2, ',', '.') }} <strong>%</strong></td>
			</tr>
			<tr>
				<td><strong>INCENTIVO</strong></td>
				<td align="right">{{ number_format( $var_vendedor->incentivo_venta * ($venta_vendedor->venta_total/$var_vendedor->cuota_venta), 2, ',', '.') }}</td>
			</tr>
	</table>
</div>

