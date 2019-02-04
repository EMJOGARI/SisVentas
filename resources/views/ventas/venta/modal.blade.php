<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $ven->idventa }}">
	{{ Form::open(['method'=>'delete', 'route'=>['venta.destroy', $ven->idventa]]) }}
	
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
					aria-label="Close">
	                     <span aria-hidden="true">×</span>
	                </button>
	                <h4 class="modal-title">Cancelar Venta</h4>
				</div>
				<div class="modal-body">
					<p>Confirme si cancelar la venta seleccionada</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Confirmar</button>
				</div>
			</div>
		</div>	
	{{ Form::Close() }}

</div>