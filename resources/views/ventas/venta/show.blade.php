@extends ('layouts.admin')
@section('content')		

	<div class="row">	            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
               {!! Form::label('proveedor', 'Proveedor') !!}             
               <p>{{ $ingreso->nombre }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('tipo_comprobante', 'Tipo Documento') !!}
                <p>{{ $ingreso->tipo_comprobante }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('serie_comprobante', 'Número de Factura') !!}
                <p>{{ $ingreso->serie_comprobante }}</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('num_comprobante', 'Número de Control') !!}
                <p>{{ $ingreso->num_comprobante }}</p>
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
					        <th scope="col">Precio Unitario</th>							      
					        <th scope="col">Subtotal</th>							    
					  	</thead>
					  	<tfoot>
					  		<th></th>						  		
					  		<th></th>
					  		<th><h4>TOTAL:</h4></th>
					  		<th><h4 id="total">{{ number_format($ingreso->total, 2, ',', '.') }}</h4></th>
					  	</tfoot>
					  	<tbody>
					  		@foreach($detalles as $det)
			                    <tr>
			                    	<td>{{ $det->articulo }}</td>
			                    	<td>{{ $det->cantidad }}</td>
			                    	<td>{{ number_format($det->precio_compra, 2, ',', '.') }}</td>
			                    	<td>{{ number_format($det->cantidad*$det->precio_compra, 2, ',', '.') }}</td>
			                    </tr>
			                @endforeach						    
					  	</tbody>
					</table>												                
	            </div>  		
        	</div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group"> 
                {!! Form::reset('Regresar', ['class'=>'btn btn-danger', 'onclick'=>'history.back()']) !!}
            </div>
        </div>
	</div>
			
@endsection