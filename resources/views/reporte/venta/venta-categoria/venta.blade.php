<div class="box box-info box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>VENTAS</strong></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-tools -->
    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="25%">Categoria</th>
					<th width="5%">Cantidad</th>
					<th width="10%">Neto</th>
				</thead>
			@foreach ($ventas as $ven)
			    <tr>
					<td>{{ $ven->categorias }}</td>
					<td align="center">{{ $ven->cantidad }}</td>
					<td align="right">{{ number_format($ven->neto, 2, ',', '.') }}</td>
				</tr>
			@endforeach
				<tr>
					<td align="center"><strong>TOTAL:</strong></td>
					<td align="center"><strong>{{ $sum_total}}</strong></td>
					<td align="right"><strong>{{ number_format($sum_neto, 2, ',', '.') }}</strong></td>
				</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>