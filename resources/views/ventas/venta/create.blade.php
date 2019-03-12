@extends ('layouts.admin')
@section('content')
	
			<h3>Nueva Venta</h3>
			
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('url'=>'ventas/venta', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{ Form::token() }}
			<div class="row">	            
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('cliente', 'Cliente') !!}
	                    <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">	                    	
	                    	@foreach($personas as $persona)
	                    		<option value="{{ $persona->idpersona }}">{{ $persona->nombre }}</option>
	                    	@endforeach
	                    </select>
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
				            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('articulo', 'Articulo') !!}
				                    <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
				                    	<option value="">Seleccioné un Articulo</option>
				                    	@foreach($articulos as $art)
				                    		<option value="{{ $art->idarticulo }}_{{ $art->stock }}_{{ $art->precio_venta }}">{{ $art->articulo }}</option>
				                    	@endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('stock', 'Stock') !!}
				                   {!! Form::number('pstock', null, ['id'=>'pstock','class'=>'form-control', 'disabled', 'style'=>'padding-left: 6px; padding-right: 6px; text-align: center;']) !!}
				                    
				                </div>
				            </div>
				            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				                <div class="form-group">				                	
				                    {!! Form::label('precio_venta', 'Precio Venta') !!}
				                    {!! Form::number('pprecio_venta', null, ['id'=>'pprecio_venta','class'=>'form-control']) !!} 
				                </div>
				            </div>
				            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('cantidad', 'Cantidad') !!}
				                    {!! Form::number('pcantidad', null, ['id'=>'pcantidad','class'=>'form-control','placeholder'=>'Cantidad']) !!}
				                </div>
				            </div>	
				             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				                <div class="form-group">
				                    {!! Form::label('descuento', 'Descuento') !!}				                    
				                    {!! Form::number('descuento', null, ['id'=>'pdescuento','class'=>'form-control','placeholder'=>'Descuento']) !!}
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
									    <th scope="col">Precio Venta</th>									    
									    <th scope="col">% Descuento</th>							      
									    <th scope="col">Subtotal</th>									    
								  	</thead>
								  	<tfoot>
								  		<th></th>
								  		<th></th>
								  		<th></th>
								  		<th></th>								  		
								  		<th><h4>TOTAL</h4></th>
								  		<th><h4 id="total">BsS. 0.00</h4> <input type="hidden" name="total_venta" id="total_venta"></th>
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
	$("#pidarticulo").change(mostrarArticulo);

	function mostrarArticulo()
	{
		datosArticulos=document.getElementById('pidarticulo').value.split('_');			
		$("#pstock").val(datosArticulos[1]);
		$("#pprecio_venta").val(datosArticulos[2]);		
	}

	function agregar()
	{
	
		datosArticulos=document.getElementById('pidarticulo').value.split('_');		
		
		idarticulo=datosArticulos[0];
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		descuento=$("#pdescuento").val();
		precio_venta=$("#pprecio_venta").val();
		stock=$("#pstock").val();
		
		if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_venta!="" && descuento!="")
		{
			if (stock>=cantidad)
			{
				//subtotal[cont]=((cantidad*precio_venta)-descuento);
				des=(descuento/100);
				/*----------------*/
				//neto[cont]=(cantidad*precio_venta);
				subtotal[cont]=(cantidad*precio_venta);
				subtotal[cont]=(subtotal[cont]-(subtotal[cont]*des));
				total=total+subtotal[cont];
				
				var fila='<tr class="selected" id="fila'+cont+'">\n\
					<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')"><i class="fa fa-close"></i></button></td>\n\
					<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>\n\
					<td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td>\n\
					<td><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">'+precio_venta+'</td>\n\
					<td><input type="hidden" name="descuento[]" value="'+descuento+'">'+descuento+'</td>\n\
					<td>'+subtotal[cont]+'</td></tr>';
				
				cont++;
				limpiar();
				$("#total").html("BsS. " + total); // number_format(total, 2, ',', '.')
				$("#total_venta").val(total);
				evaluar();
				$('#detalles').append(fila);
			}
			else
			{
				alert('La cantidad a vender supera el stock');
			}
			
		}
		else
		{
			alert("Error al ingresar el detalle de la venta, revise los datos del articulo")
		}
	}

	function limpiar()
	{
		$("#pcantidad").val("");
		$("#pdescuento").val("");
		$("#pcosto").val("");		
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
		$("#total_venta").val(total);
		$("#fila" + index).remove();
		evaluar();
	}
</script>
@endpush
@endsection