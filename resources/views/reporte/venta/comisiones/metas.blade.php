<div class="box box-info">
    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="30%"></th>
					<th width="10%"></th>
				</thead>
					<tr>
						<td><strong>META A CUMPLIR</strong></td>
						<td align="right">{{ number_format( $var->meta_cumplir, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>META ALCANZADA</strong></td>
						<td align="right">{{ number_format( $sum_total_venta , 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>% META</strong></td>
						<td align="right">{{ number_format((($sum_total_venta/$var->meta_cumplir))*100, 3, ',', '.') }} <strong>%</strong></td>
					</tr>
					<tr>
						<td><strong>OBJ. ALCANZADO</strong></td>
						<td align="right">{{ number_format( $var->objetivo_meta * ((($sum_total_venta/$var->meta_cumplir))), 2, ',', '.') }}</td>
					</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>
