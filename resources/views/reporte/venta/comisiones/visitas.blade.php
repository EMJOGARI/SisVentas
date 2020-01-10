<div class="box box-info">
    <div class="box-body"><!-- /.box-header -->
      	<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th width="30%"></th>
					<th width="10%"></th>
				</thead>
					<tr>
						<td><strong>CLIENTES A VISITAR</strong></td>
						<td align="right">{{ number_format( $var->visita_activa, 0, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>CLIENTES VISITADOS</strong></td>
						<td align="right">{{ number_format( $num_clientes->clientes , 0, ',', '.') }}</td>
					</tr>
					<tr>
						<td><strong>% CLIENTES</strong></td>
						<td align="right">{{ number_format((($num_clientes->clientes/$var->visita_activa))*100, 3, ',', '.') }} <strong>%</strong></td>
					</tr>
					<tr>
						<td><strong>OBJ. ALCANZADO</strong></td>
						<td align="right">{{ number_format( $var->objetivo_visita * ((($num_clientes->clientes/$var->visita_activa))), 2, ',', '.') }}</td>
					</tr>
			</table>
		</div>
    </div><!-- /.box-body -->
</div>
