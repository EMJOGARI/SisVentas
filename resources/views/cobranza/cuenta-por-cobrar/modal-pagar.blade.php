<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pagar-{{ $ven->idventa }}">
	{{ Form::open(['method'=>'PUT', 'route'=>['cuenta-por-cobrar.update', $ven->idventa]]) }}

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
	                     <span aria-hidden="true">×</span>
	                </button>
	                <h4 class="modal-title"><strong>Pagar Factura</strong></h4>
				</div>
				<div class="modal-body">
					<div class="row">
				        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				            <div class="form-group">
				               {!! Form::label('proveedor', 'Cliente') !!}
				               <p>{{ $ven->nombre }}</p>
				            </div>
				        </div>
				        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				               {!! Form::label('Fecha', 'Fecha Factura') !!}
				               <p>{{ date('d-m-Y', strtotime($ven->fecha_hora)) }}</p>
				            </div>
				        </div>
				        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				                {!! Form::label('tipo_comprobante', 'Nº del Documento') !!}
				                <p>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.' - '.$ven->num_comprobante }}</p>
				            </div>
				        </div>
				         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            <div class="form-group">
				                {!! Form::label('tipo_comprobante', 'Monto Neto') !!}
				                <p>{{ number_format($ven->total_venta, 2, ',', '.') }}</p>
				            </div>
				        </div>
				        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				            <div class="form-group">
				                {!! Form::label('detalle', 'Nota') !!}
				                {!! Form::textarea('detalle', null, ['class'=>'form-control', 'rows' => 4, 'cols' => 54, 'placeholder'=>'Nota', 'required']) !!}
				            </div>
				        </div>
				         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
			                <div class="form-group">
			                	<div class="input-group">
			                        <span class="input-group-addon">
										{!! Form::checkbox('up_stado') !!}
			                        </span>
									<p class="form-control"><strong> Pagar factura</strong></p>
		                  		</div>
		                	</div>
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