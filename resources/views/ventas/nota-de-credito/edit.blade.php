@extends ('layouts.admin')

@section('name', "Crear Nota de Credito")

@section('content')

	@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="row">
		 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	        <div class="info-box bg-green">
	            <span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
	            <div class="info-box-content">
	              <span class="info-box-text">Cliente</span>
	              <span class="info-box-number">{{ $ventas->nombre }}</span>
	            </div>
	        </div>
	    </div>
		 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Vendedor</span>
                  <span class="info-box-number">{{ $vendedor->nombre }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-th"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Factura Nº</span>
                  <span class="info-box-number">{{ $ventas->serie_comprobante.' - '.$ventas->num_comprobante }}</span>
                </div>
            </div>
        </div>
	</div>
	{{--{!! Form::open(array('url'=>'ventas/nota-de-credito', 'method'=>'POST', 'autocomplete'=>'off')) !!}--}}
	{{--{!! Form::open(array('route'=>['nota-de-credito.update',$ventas->idventa], 'method'=>'PUT', 'autocomplete'=>'off')) !!}--}}

	{!! Form::model($ventas['method'=>'PUT', 'route'=>['nota-de-credito.update',$ventas->idventa], 'file'=>'true']) !!}

	{{ Form::token() }}

		<div class="row">
	        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
	        	{!! Form::label('','Fecha') !!}
	            <div class="input-group">
	                <input type="text" class="form-control datepicker" name="purchase_date" value="{{ date('d-m-Y') }}" disabled>
	                <div class="input-group-addon">
	                    <a href="#"><i class="fa fa-calendar"></i></a>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	            <div class="form-group">
	                {!! Form::label('num_noce', 'Nota de Credito Nº') !!}
	                {!! Form::number('num_noce', null, ['required','class'=>'form-control', 'placeholder'=>'Número de Control']) !!}
	            </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	            <div class="form-group">
	                {!! Form::label('serie_noce', 'Control Nº') !!}
	                {!! Form::number('serie_noce', null, ['required','class'=>'form-control', 'placeholder'=>'Número de Control']) !!}
	            </div>
	        </div>
		</div>
		<div class="panel panel-primary">
        	<div class="panel-body">
		            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('articulo', 'Articulo') !!}
		                    <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
		                    	<option value="">Seleccioné un Articulo</option>
		                    	@foreach($detalles as $art)
		                    		<option value="{{ $art->idarticulo }}_{{ $art->stock }}_{{ $art->precio_venta }}">
		                    			{{  str_pad($art->idarticulo, 3, "0", STR_PAD_LEFT).' - '.$art->nombre }}</option>
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
		                    {!! Form::text('pprecio_venta', null, ['id'=>'pprecio_venta','class'=>'form-control']) !!}
		                </div>
		            </div>
		            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('cantidad', 'Cantidad') !!}
		                    {!! Form::text('pcantidad', null, ['id'=>'pcantidad','class'=>'form-control','placeholder'=>'Cantidad']) !!}
		                </div>
		            </div>
		            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('descuento', 'Descuento') !!}
		                    {!! Form::number('descuento', null, ['id'=>'pdescuento','class'=>'form-control','placeholder'=>'Descuento']) !!}
		                </div>
		            </div>
		            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		            	{!! Form::label('','') !!}
		                <div class="form-group">
		                    <button id="bt_add" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Agregar</button>
		                </div>
		            </div>
		            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		            	<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						  	<thead style="background-color:#f4f4f4">
							    <th width="40%" scope="col">Articulo</th>
							    <th width="5%" scope="col">Cantidad</th>
							    <th width="15%" scope="col">Precio Unit.</th>
							    <th width="15%" scope="col">% Descuento</th>
							    <th width="15%" scope="col">Precio Total</th>
							    <th width="5%" scope="col">Opcion</th>
						  	</thead>
						  	<tfoot>
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		<th><h4><strong>TOTAL</strong></h4></th>
						  		<th><h4 id="total" style="font-weight: bold;">BsS. 0.00</h4> <input type="hidden" name="total_credito" id="total_credito"></th>
						  		<th></th>
						  	</tfoot>
						  	<tbody>

						  	</tbody>
						</table>
		            </div>
        	</div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
            <div class="form-group">
            	<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Confirmar</button>
            	<button class="btn btn-danger" onclick="history.back()" type="reset" ><i class="fa fa-close"></i> Cancelar</button>
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
				des=(descuento/100);
				subtotal[cont]=(cantidad*precio_venta);
				subtotal[cont]=(subtotal[cont]-(subtotal[cont]*des));
				total=total+subtotal[cont];

				var fila='<tr class="selected" id="fila'+cont+'">\n\
					<td align="left"><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>\n\
					<td align="right"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td>\n\
					<td align="right"><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">'+precio_venta+'</td>\n\
					<td align="right"><input type="hidden" name="descuento[]" value="'+descuento+'">'+descuento+'</td>\n\
					<td align="right">'+subtotal[cont]+'</td>\n\
					<td align="right"><button type="button" class="btn btn-danger" onclick="eliminar('+cont+')"><i class="fa  fa-trash"></i></button></td>\n\
					</tr>';

				cont++;
				limpiar();
				$("#total").html("BsS. " + total); // number_format(total, 2, ',', '.')
				$("#total_credito").val(total);
				evaluar();
				$('#detalles').append(fila);
			}
			else
			{
				alert('La cantidad a vender supera la cantidad');
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
		$("#total_credito").val(total);
		$("#fila" + index).remove();
		evaluar();
	}
</script>
@endpush
@endsection