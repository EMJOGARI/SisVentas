@extends ('layouts.admin')
@section('name', "Detalles de la Venta")
@section('content')

	<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Cliente</span>
                  <span class="info-box-number">{{ $venta->nombre }}</span>
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
                  <span class="info-box-number">{{ $venta->serie_comprobante.' - '.$venta->num_comprobante }}</span>
                </div>
            </div>
        </div>
	</div>
	<div class="row">
        <div class="panel panel-primary">
        	<div class="panel-body">
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            	<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					  	<thead style="background-color:#A9D0F5">
					        <th width="40%" scope="col">Articulo</th>
                            <th width="5%" scope="col">Cantidad</th>
                            <th width="15%" scope="col">Precio Unidad</th>
                            <th width="15%" scope="col">Venta Neta</th>
                            <th width="10%" scope="col">% Descuento</th>
                            <th width="15%" scope="col">Subtotal</th>
					  	</thead>
					  	<tfoot>
					  		<th></th>
					  		<th></th>
                            <th></th>
                            <th></th>
					  		<th><h4><strong>TOTAL:</strong></h4></th>
					  		<th><h4 id="total"><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></h4></th>
					  	</tfoot>
					  	<tbody>
					  		@foreach($detalles as $det)
			                    <tr>
			                    	<td>{{ $det->idarticulo.' - '.$det->articulo }}</td>
			                    	<td align="center">{{ $det->cantidad }}</td>
			                    	<td align="right">{{ number_format($det->precio_venta, 2, ',', '.') }}</td>
                                    <td align="right">{{ number_format($det->cantidad*$det->precio_venta, 2, ',', '.') }}</td>
                                    <td align="center">{{ $det->descuento }}</td>
			                    	<td align="right">{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</td>
			                    </tr>
			                @endforeach
					  	</tbody>
					</table>
	            </div>
        	</div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-danger" onclick="history.back()" type="reset"><i class="fa fa-hand-o-left" value="Regresar"></i> Regresar</button>
            </div>
        </div>
	</div>

@endsection