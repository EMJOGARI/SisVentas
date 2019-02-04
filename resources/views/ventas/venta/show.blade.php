@extends ('layouts.admin')
@section('content')		

	<div class="row">	            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
               {!! Form::label('proveedor', 'Cliente') !!}             
               <p>{{ $venta->nombre }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('tipo_comprobante', 'Tipo Documento') !!}
                <p>{{ $venta->tipo_comprobante }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('serie_comprobante', 'Número de Factura') !!}
                <p>{{ $venta->serie_comprobante }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('num_comprobante', 'Número de Control') !!}
                <p>{{ $venta->num_comprobante }}</p>
            </div>
        </div>	            
	</div>
	<div class="row">
        <div class="panel panel-primary">
        	<div class="panel-body"> 
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            	<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					  	<thead style="background-color:#A9D0F5">							   							      
					        <th scope="col">Articulo</th>
					        <th scope="col">Cantidad</th>
					        <th scope="col">Precio Venta</th>
                            <th scope="col">Venta Neta</th>
                            <th scope="col">% Descuento</th>							      
					        <th scope="col">Subtotal</th>							    
					  	</thead>
					  	<tfoot>
					  		<th></th>						  		
					  		<th></th>
                            <th></th>
                            <th></th>
					  		<th><h4>TOTAL:</h4></th>
					  		<th><h4 id="total">{{ number_format($venta->total_venta, 2, ',', '.') }}</h4></th>
					  	</tfoot>
					  	<tbody>
					  		@foreach($detalles as $det)
			                    <tr>
			                    	<td>{{ $det->articulo }}</td>
			                    	<td>{{ $det->cantidad }}</td>
			                    	<td>{{ number_format($det->precio_venta, 2, ',', '.') }}</td>
                                    <td>{{ number_format($det->cantidad*$det->precio_venta, 2, ',', '.') }}</td>
                                    <td>{{ $det->descuento }}</td>
			                    	<td>{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</td>
			                    </tr>                                
			                @endforeach						    
					  	</tbody>
					</table>												                
	            </div>  		
        	</div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group"> 
                <button class="btn btn-danger" onclick="history.back()" type="reset"><i class="fa fa-hand-o-left" value="Regresar"></i> Regresar</button>
            </div>
        </div>
	</div>
			
@endsection