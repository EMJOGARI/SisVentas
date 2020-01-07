<div class="box box-success">

    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="30%"></th>
					<th width="5%">Cantidad</th>
					<th width="10%">Neto</th>
				</thead>
					<tr>
						<td><strong>VENTA TOTAL</strong></td>
						<td align="center">{{ $sum_total }}</td>
						<td align="right">{{ number_format( $sum_neto, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>NOTA DE CREDITO</strong></td>
						<td align="center">{{ $noce_sum_total }}</td>
						<td align="right">{{ number_format( $noce_sum_neto, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td></td>
						<td align="centeR"><strong>{{  $sum_total - $noce_sum_total }}</strong></td>
						<td align="right"><strong>{{ number_format($sum_neto - $noce_sum_neto, 2, ',', '.') }}</strong></td>
					</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>
