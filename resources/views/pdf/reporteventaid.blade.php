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
	        font-size: 16px;
	    }
	    .fecha{
	    	font-size:20px;
	    }
	    .datos{
	    	margin-top: 8.6rem
	    }   
	    .tabla1{
	        margin-bottom: 20px;
	        padding: 0 2rem 0 2rem;
	    }
	    .tabla2 {
	        margin-bottom: 2px;
	        margin-top: 2px
	        padding: 0 1rem 0 1rem;
	    }
	    .detalles {
	    	margin-top: 15px;
			height: 50mm;    	
	    }
	    .detalles .tabla3{
	        margin-top: 0;
	        padding: 0 2rem 0 2rem;        
	    }
	    .tabla4{
	        margin-top: 1.2rem;
	        padding: 0 2rem 0 2rem;
	    } 
	</style>
</head>
<body>

	<div class="datos" width="70%">
		<table width="100%" class="tabla2">
		    <tr>
		    	<td width="20%"></td>		    		    		        
		        <td width="50%"><span>{{ $venta->nombre }}</span></td>	
		        <td width="30%" class="fecha"><span><strong>{{ date('d/m/Y', strtotime($venta->fecha_hora)) }}</strong></span></td>        
		    </tr>		    	    		    
		</table>
		<table width="100%" class="tabla2">		    
		    <tr>
		    	<td></td>		       
		        <td width="95%"><span>{{ $venta->direccion }}</span></td>		        
		    </tr>
		</table>
		<table width="100%" class="tabla2">
		    <tr>
		    	<td></td>	        
		        <td width="95%"><span>Cedula o RIF: {{ $venta->tipo_documento.'-'.$venta->num_documento }} / Telefono: {{ $venta->telefono }}</span></td>        
		    </tr>		   
		</table>		
	</div>

	<div class="detalles">
		<table width="100%" class="tabla3">	   
		    @foreach($detalles as $det)		
			    <tr>
			        <td width="10%" align="left"><span>{{ $det->cantidad }}</span></td>
			        <td width="60%"><span>{{ $det->articulo }}</span></td>
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
		
	</div>

</body>
</html>