<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">

<head>
	<meta charset="UTF-8">
	<title>{{ $venta->tipo_comprobante.': '.$venta->serie_comprobante.' - '.$venta->num_comprobante }}</title>


	<style>
	    table{
	    	width:100%;
	        border-collapse: collapse;
	    }
	    th, td{
	        font-size: 12px;
	    }

	    .datos{
	    	margin-top: 5.8rem
	    }
	    .fecha{
	    	font-size:18px;
	    }
	    .detalles {
	   		margin-top: 5px;
			height: 24.5rem;
			border: 0.2px solid #000;
			border-radius: 10px;
			text-transform: uppercase;
	    }
	    .detalles table thead{
	    	text-align: center;
	     	background: #f4f4f4;
	     	border: 0.2px solid #000;
	    }
	    .total{
	    	margin-top: 5px;
	    	width:30%;
	        text-transform: uppercase;
	        border: 0.2px solid #000;
	        border-radius: 10px;
	    }
	    .total table{
	        text-transform: uppercase;
	        margin: 5px;
	    }
	</style>
</head>
<body>
	<div class="datos">
		<table width="100%" class="tabla2">
			<thead>
			    <tr>
				    <th width="20%"></th>
				    <th width="20%"></th>
				    <th width="20%"></th>
				    <th width="20%"></th>
				    <th width="20%"></th>
			    </tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				    <td rowspan="3" align="center" class="fecha"><strong>{{ date('d/m/Y', strtotime($venta->fecha_hora)) }}</strong></td>
			    </tr>
			    <tr>
			      	<td colspan="4">{{ $venta->nombre }}</td>
			    </tr>
			    <tr>
			      	<td colspan="2">Cedula o RIF: {{ $venta->tipo_documento.'-'.$venta->num_documento }}</td>
			      	<td colspan="2">Telefono: {{ $venta->telefono }}</td>
			    </tr>
			    <tr>
			      	<td colspan="4">{{ $venta->direccion }}</td>
			      	<td colspan="1">C.C. Nº: {{ str_pad($venta->idcliente, 3, "0", STR_PAD_LEFT) }} - C.V. Nº: {{ $venta->idvendedor }}</td>
			    </tr>

			</tbody>
		</table>
	</div>
	<div class="detalles">
		<table>
			<thead>
			    <tr>
					<td width="10%">Codigo</td>
					<td width="50%">Descripción</td>
					<td width="10%">Cant.</td>
					<td width="15%">Precio</td>
					<td width="15%">Total</td>
				</tr>
			</thead>
		    @foreach($detalles as $det)
			    <tr>
			    	<td align="center">{{ str_pad($det->idarticulo, 3, "0", STR_PAD_LEFT) }}</td>
			        <td>{{ $det->articulo }}</td>
			        <td align="center">{{ $det->cantidad }}</td>
			        <td align="right">{{ number_format($det->precio_venta, 2, ',', '.') }}</td>
			        <td align="right">{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}<</td>
			    </tr>
		   	@endforeach
		</table>
	</div>
	<div class="total pull-right">
		<table>
			<thead>
			    <tr>
					<td width="50%"></td>
					<td width="50%"></td>
				</tr>
			</thead>
			<tr>
		        <td align="left"><strong>Subtotal</strong></td>
		        <td align="right"><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></td>
		    </tr>
		    <tr>
		        <td align="left"><strong>descuento</strong></td>
		        <td align="right"><strong>{{ number_format(0, 2, ',', '.') }}</strong></td>
		    </tr>
		    <tr>
		        <td align="left"><strong>total</strong></td>
		        <td align="right"><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></td>
		    </tr>
		</table>
	</div>

	<script src="{{ asset('/assets/js/jQuery-2.1.4.min.js') }}"></script>
 <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
</body>
</html>