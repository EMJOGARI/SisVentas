@extends ('layouts.admin')
@section('name', "Detalles de la Compra")
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
                {!! Form::label('tipo_comprobante', 'Nº del Documento') !!}
                <p>{{ $ingreso->tipo_comprobante.': '.$ingreso->serie_comprobante.' - '.$ingreso->num_comprobante }}</p>
            </div>
        </div>                   
	</div>
	<div class="row">
        <div class="panel panel-primary">
        	<div class="panel-body"> 
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            	<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					  	<thead style="background-color:#A9D0F5">							   							      
					        <th width="65%" scope="col">Articulo</th>
					        <th width="5%" scope="col">Cantidad</th>
					        <th width="15%" scope="col">Precio Unitario</th>							      
					        <th width="15%" scope="col">Subtotal</th>							    
					  	</thead>
					  	<tfoot>
					  		<th></th>						  		
					  		<th></th>
					  		<th><h4><strong>TOTAL:</strong></h4></th>
					  		<th><h4 id="total"><strong>{{ number_format($ingreso->total, 2, ',', '.') }}</strong></h4></th>
					  	</tfoot>
					  	<tbody>
					  		@foreach($detalles as $det)
			                    <tr>
			                    	<td>{{ $det->articulo }}</td>
			                    	<td align="center">{{ $det->cantidad }}</td>
			                    	<td align="right">{{ number_format($det->precio_compra, 2, ',', '.') }}</td>
			                    	<td align="right">{{ number_format($det->cantidad*$det->precio_compra, 2, ',', '.') }}</td>
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