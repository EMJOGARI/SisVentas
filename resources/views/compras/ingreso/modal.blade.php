<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $ing->idingreso }}">
	{{ Form::open(['method'=>'delete', 'route'=>['ingreso.destroy', $ing->idingreso]]) }}
	
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
					aria-label="Close">
	                     <span aria-hidden="true">×</span>
	                </button>
	                <h4 class="modal-title"><strong>Cancelar Ingreso</strong></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				            <div class="form-group">
				               {!! Form::label('proveedor', 'Proveedor') !!}             
				               <p>{{ $ing->nombre }}</p>
				            </div>
				        </div>
				        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				               {!! Form::label('Fecha', 'Fecha Factura') !!}             
				               <p>{{ date('d-m-Y', strtotime($ing->fecha_hora)) }}</p>
				            </div>
				        </div>
				        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				                {!! Form::label('tipo_comprobante', 'Nº del Documento') !!}
				                <p>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.' - '.$ing->num_comprobante }}</p>
				            </div>
				        </div>
				         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				                {!! Form::label('tipo_comprobante', 'Monto Neto') !!}
				                <p>{{ number_format($ing->total_compra, 2, ',', '.') }}</p>
				            </div>
				        </div>
				        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					        <h4><strong>Confirme si Cancelar Ingreso</strong></h4>
					    </div>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Confirmar</button>
				</div>
			</div>
		</div>	
	{{ Form::Close() }}

</div>