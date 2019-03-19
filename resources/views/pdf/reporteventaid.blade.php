<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $venta->tipo_comprobante.': '.$venta->serie_comprobante.' - '.$venta->num_comprobante }}</title>
	<style>	
	{{--body{
			margin: 0px;	
			/*margin: 20mm 8mm 2mm 8mm;*/
		}

		
		table{
			font-family: arial, sans-serif;	
			
			width: 100%;
			font-size: 15px;
			align-items: center;
		} --}}
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
    	margin-top: 4.5rem
    }   
    .tabla1{
        margin-bottom: 20px;
        padding: 0 2rem 0 2rem;
    }
    .tabla2 {
        margin-bottom: 4px;
        margin-top: 4px
        padding: 0 2rem 0 2rem;
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
        margin-top: 0.8rem;
        padding: 0 2rem 0 2rem;
    }    
   
   
	</style>
</head>
<body> 

	<table width="100%" class="tabla1">
	    <tr>
	        <td width="11%"></td>
	        <td width="37%"><span class="text"></span></td>
	        <td width="5%">&nbsp;</td>
	        <td width="13%">&nbsp;</td>
	        <td width="4%">&nbsp;</td>
	        <td width="7%" align="center" class=""><strong></strong></td>
	        <td width="8%" align="center" class=""><strong></strong></td>
	        <td width="7%" align="center" class=""><strong></strong></td>
	    </tr>
	    <tr>
	        <td></td>
	        <td class=""><span class="text"></span></td>
	        <td></td>
	        <td class=""><span class="text"></span></td>
	        <td>&nbsp;</td>
	        <td align="center" class="fecha"><span class="text"><strong>{{ date('d') }}</strong></span></td>
	        <td align="center" class="fecha"><span class="text"><strong>{{ date('m') }}</strong></span></td>
	        <td align="center" class="fecha"><span class="text"><strong>{{ date('Y') }}</strong></span></td>
	    </tr>
	</table>

	<div class="datos">
		<table width="100%" class="tabla2">
		    <tr>
		    	<td></td>	        
		        <td width="80%"><span class="text">{{ $venta->nombre }}</span></td>	        
		    </tr>		    
		</table>
		<table width="100%" class="tabla2">		    
		    <tr>
		    <td></td>		       
		        <td width="90%"><span class="text">{{ $venta->direccion }}</span></td>		        
		    </tr>
		</table>
		<table width="100%" class="tabla2">
		    <tr>
		    <td></td>	        
		        <td width="20%" align="left"><span class="text"> {{ $venta->tipo_documento.'-'.$venta->num_documento }}</span></td>
		        <td width="30%"><span class="text">{{ $venta->telefono }}</span></td>	        
		    </tr>		   
		</table>		
	</div>
		
	<div class="detalles">
		<table width="100%" class="tabla3">	   
		    @foreach($detalles as $det)		
			    <tr>
			        <td width="7%" align="left"><span class="text">{{ $det->cantidad }}</span></td>
			        <td width="59%"><span class="text">{{ $det->articulo }}</span></td>
			        <td width="16%" align="right"><span class="text">{{ number_format($det->precio_venta, 2, ',', '.') }}</span></td>
			        <td width="18%" align="right"><span class="text">{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</span></td>
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
		        <td align="right"><span class="text"><strong>{{ number_format($venta->total_venta, 2, ',', '.') }}</strong></span></td>
		    </tr>	
		</table>
		
	</div>
    










	{{--
	
	<table width="100%">
		<tr  align="right" >
			<td style="width: 50%">				
				{{ date('d') }} {{ date('m') }} {{ date('Y') }}				 
			</td>
		</tr>		
	</table>
	
	
	<table>		
		<tr>
			<td>{{ $venta->nombre }} </td>

			<td>{{ $venta->direccion }} </td>			
		</tr>
	</table>

	
	<table>
		<tr style="background-color: #dddddd;">
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>Precio Venta</th>
			<th>% Descuenta</th>
			<th>Subtotal</th>
		</tr>
			@foreach($detalles as $det)
				<tr>
					<td>{{ $det->articulo }}</td>
	            	<td>{{ $det->cantidad }}</td>	            	
	            	<td>{{ number_format($det->precio_venta, 2, ',', '.') }}</td>
	            	<td>{{ $det->descuento }}</td>
	            	<td>
	            		{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</td>
				</tr>
			@endforeach	
		<tr>
			<th></th>						  		
	  		<th></th>
	  		<th></th>
	  		<th><h4>TOTAL:</h4></th>
	  		<th><h4 id="total">{{ number_format($venta->total_venta, 2, ',', '.') }}</h4></th>
		</tr>
	</table>
--}}
</body>
</html>