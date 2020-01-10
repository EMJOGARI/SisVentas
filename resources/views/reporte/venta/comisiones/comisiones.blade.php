<div class="box box-info">
    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="30%"></th>
					<th width="10%"></th>
				</thead>
					<tr>
						<td><strong>TOTAL VENTAS</strong></td>
						<td align="right">{{ number_format( $sum_total_venta, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>COMISIONES 3%</strong></td>
						<td align="right">{{ number_format( $sum_total_venta *($var->comision_max/100), 2, ',', '.') }}</td>
					</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>