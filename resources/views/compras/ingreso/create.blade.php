@extends ('layouts.admin')
@section('content')
	
			<h3>Nuevo Ingreso</h3>
			
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('url'=>'compras/ingreso', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{ Form::token() }}
			<div class="row">	            
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            	<div class="form-group">
		            	{!! Form::label('proveedor', 'Proveedor') !!}
		                <div class="input-group">	                    
		                    <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
		                    	<option value="">Seleccioné un Proveedor</option>
		                    	@foreach($personas as $persona)
		                    		<option value="{{ $persona->idpersona }}">{{ $persona->nombre }}</option>
		                    	@endforeach
		                    </select>
		                    <div class="input-group-btn">
			                	<a href="{{ url('seguridad/persona/create') }}" type="button" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Proveedor</a>                  
			                </div>
		                </div>
	                </div>
	            </div>					

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('tipo_comprobante', 'Tipo Documento') !!}
	                    <select name="tipo_comprobante" class="form-control"> 
	                    	<option value="factura">Factura</option>
	                    	<option value="nota_entrega">Nota de Entrega</option>
	                    </select>
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('serie_comprobante', 'Número de Factura') !!}
	                    {!! Form::text('serie_comprobante', null, ['class'=>'form-control', 'placeholder'=>'Número de Factura']) !!}
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('num_comprobante', 'Número de Control') !!}
	                    {!! Form::text('num_comprobante', null, ['required','class'=>'form-control', 'placeholder'=>'Número de Control']) !!}
	                </div>
	            </div>	            
	    	</div>
	    	<div class="row">
	            <div class="panel panel-primary">
	            	<div class="panel-body">	            			            
				            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('articulo', 'Articulo') !!}
				                    <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
				                    	<option value="">Seleccioné un Articulo</option>
				                    	@foreach($articulos as $articulo)
				                    		<option value="{{ $articulo->idarticulo }}">{{ $articulo->articulo }}</option>
				                    	@endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('cantidad', 'Cantidad') !!}
				                    {!! Form::number('cantidad', null, ['id'=>'pcantidad','class'=>'form-control','placeholder'=>'Cantidad']) !!}
				                </div>
				            </div>
				            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('precio_compra', 'Precio Unitario') !!}
				                    {!! Form::number('precio_compra', null, ['id'=>'pprecio_compra','class'=>'form-control','placeholder'=>'P. Unidad']) !!}
				                </div>
				            </div>				            		            
				            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				                <div class="form-group">
				                	<button id="bt_add" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Agregar</button>          
				                </div>
				            </div>
				            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				            	<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								  	<thead style="background-color:#A9D0F5">									    
									    <th scope="col">Opciones</th>
									    <th scope="col">Articulo</th>
									    <th scope="col">Cantidad</th>
									    <th scope="col">Precio Unitario</th>							      
									    <th scope="col">Subtotal</th>									    
								  	</thead>
								  	<tfoot>
								  		<th><h4>TOTAL</h4></th>
								  		<th></th>
								  		<th></th>
								  		<th></th>
								  		<th><h4 id="total">BsS. 0.00</h4></th>
								  	</tfoot>
								  	<tbody>
								    
								  	</tbody>
								</table>												                
				            </div>  		
	            	</div>
	            </div>
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
	                <div class="form-group">
	                	<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                	<button class="btn btn-danger" onclick="history.back()" type="reset" ><i class="fa fa-close"></i> Cancelar</button>
	                </div>
	            </div>
			</div>
			{!! Form::close() !!}
	

@push('scripts')

<script>
	$(document).ready(function(){
	$('#bt_add').click(function(){
		agregar();
	});
});

var cont=0;
total=0;
subtotal=[];
$("#guardar").hide();

function agregar()
{
	idarticulo=$("#pidarticulo").val();
	articulo=$("#pidarticulo option:selected").text();
	cantidad=$("#pcantidad").val();
	precio_compra=$("#pprecio_compra").val();	

	if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="")
	{
		subtotal[cont]=(cantidad*precio_compra);
		total=total+subtotal[cont];
		
		var fila='<tr class="selected" id="fila'+cont+'">\n\
			<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')"><i class="fa fa-close"></i></button></td>\n\
			<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>\n\
			<td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td>\n\
			<td><input type="hidden" name="precio_compra[]" value="'+precio_compra+'">'+precio_compra+'</td>\n\
			<td>'+subtotal[cont]+'</td></tr>';
		
		cont++;
		limpiar();
		$("#total").html("BsS. " + total);
		evaluar();
		$('#detalles').append(fila);
	}
	else
	{
		alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
	}
}

function limpiar()
{
	$("#pcantidad").val("");
	$("#pprecio_compra").val("");	
}

function evaluar()
{
	if (total>0)
	{
		$("#guardar").show();
	}
	else
	{
		$("#guardar").hide();	
	}
}

function eliminar(index)
{
	total=total-subtotal[index];
	$("#total").html("BsS. " + total);
	$("#fila" + index).remove();
	evaluar();
}
	
</script>
@endpush

@endsection