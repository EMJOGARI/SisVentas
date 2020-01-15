<div class="box box-success box-solid">
    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="30%"></th>
					<th width="10%"></th>
				</thead>
					<tr>
						<td><strong>COMISIONES 3%</strong></td>
						<td align="right">{{ number_format( $sum_total_venta *($var->comision_max/100), 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>INCENT. DE VENTAS</strong></td>
						<td align="right">{{ number_format( $var_vendedor->incentivo_venta * ($venta_vendedor->venta_total/$var_vendedor->cuota_venta), 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>INCENT. DE ACTIVADOS</strong></td>
						<td align="right">{{ number_format( $var_vendedor->incentivo_cliente_activar * ($num_clientes->clientes/$var_vendedor->cuota_cliente_activar), 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>TOTAL</strong></td>
						<td align="right"><strong>{{ number_format( ($sum_total_venta *($var->comision_max/100))+($var_vendedor->incentivo_venta * ($venta_vendedor->venta_total/$var_vendedor->cuota_venta))+($var_vendedor->incentivo_cliente_activar * ($num_clientes->clientes/$var_vendedor->cuota_cliente_activar)), 2, ',', '.') }}</strong></td>
					</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>