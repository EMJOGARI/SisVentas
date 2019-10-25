<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<title>{{ $venta->tipo_comprobante.': '.$venta->serie_comprobante.' - '.$venta->num_comprobante }}</title>


	<style>
		body{
			margin-top: 1.5rem;
		    font-size: 16px;
		    font-family: "Arial";
	    }
	    table{
	        border-collapse: collapse;
	    }
	    td{
	        padding: 2px 2px;
	        font-size: 14px;
	    }
	    .fecha{
	    	font-size:20px;
	    }
	    .datos{
	    	margin-top: 7.2rem
	    }
	    .tabla2 tbody tr{
	        margin-bottom: 20px;
	        margin-top: 20px
	        padding: 0;
	    }
	    .detalles {
	    	margin-top: 2rem;
			height: 42mm;
	    }
	    .detalles .tabla3{
	        margin-top: 0;
	        padding: 0;
	        text-transform: uppercase;
	    }
	    .tabla4{
	        margin-top: 0;
	        padding: 0;
	    }
	    .tabla5{
	        margin-top: 2.3rem;
	        padding: 0;
	    }
	</style>
</head>
<body>
	<div class="datos">
		<table width="100%" class="tabla2">
			<thead>
			    <tr>
				    <th width="50%"></th>
				    <th width="20%"></th>
				    <th width="30%"></th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
			      	<td><span>{{ $venta->nombre }}</span></td>
			    </tr>
			    <tr>
			      	<td><span>{{ $venta->direccion }}</span></td>
			      	<td></td>
			      	<td class="fecha" align="center"><span><strong>{{ date('d/m/Y', strtotime($venta->fecha_hora)) }}</strong></span></td>
			    </tr>
			    <tr>
			      	<td><span>Cedula o RIF: {{ $venta->tipo_documento.'-'.$venta->num_documento }} / Telefono: {{ $venta->telefono }}</span></td>
			    </tr>
			</tbody>
		</table>
	</div>
	<div class="detalles">
		<table width="100%" class="tabla3">
		    @foreach($detalles as $det)
			    <tr>
			        <td width="10%" align="center"><span>{{ $det->cantidad }}</span></td>
			        <td width="70%"><span>{{ $det->articulo }}</span></td>
			        <td width="15%" align="right"><span>{{ number_format($det->precio_venta, 2, ',', '.') }}</span></td>
			        <td width="15%" align="right"><span>{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</span></td>
			    </tr>
		   	@endforeach
		</table>
	</div>

	<div>
		<table  width="100%" class="tabla4">
			<tr>
		        <td style="border:0;">&nbsp;</td>
		        <td style="border:0;">&nbsp;</td>
		        <td align="right"></td>
		        <td align="right"><span><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></span></td>
		    </tr>
		</table>
		<table  width="100%" class="tabla5">
			<tr>
		        <td style="border:0;">&nbsp;</td>
		        <td style="border:0;">&nbsp;</td>
		        <td align="right"></td>
		        <td align="right"><span><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></span></td>
		    </tr>
		</table>
	</div>

</body>
</html>