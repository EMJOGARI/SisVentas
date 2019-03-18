<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle Venta</title>
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
	    font-size: 14px;
	    font-family: "Arial";
    }
    table{
        border-collapse: collapse;
    }
    td{
        padding: 6px 5px;
        font-size: 14px;
    }
    .fecha{
    	font-size:20px;
    }
    .h1{
        font-size: 21px;
        font-weight: bold;
    }
    .h2{
        font-size: 18px;
        font-weight: bold;
    }
    .tabla1{
        margin-bottom: 20px;
    }
    .tabla2 {
        margin-bottom: 20px;
    }
    .tabla3{
        margin-top: 15px;
    }
    .tabla3 td{
       /*border: 1px solid #000;*/
    }
    .tabla3 .cancelado{
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        border-top: 1px dotted #000;
        width: 200px;
    }
    .emisor{
        color: red;
    }
    .linea{
        border-bottom: 1px dotted #000;
    }
    .border{
        border: 1px solid #000;
    }
    .fondo{
        background-color: #dfdfdf;
    }
    .fisico{
        color: #fff;
    }
    .fisico td{
        color: #fff;
    }
    .fisico .border{
        border: 1px solid #fff;
    }
    .fisico .tabla3 td{
        border: 1px solid #fff;
    }
    .fisico .linea{
        border-bottom: 1px dotted #fff;
    }
    .fisico .emisor{
        color: #fff;
    }
    .fisico .tabla3 .cancelado{
        border-top: 1px dotted #fff;
    }
    .fisico .text{
        color: #000;
    }
    .fisico .fondo{
        background-color: #fff;
    }    
	</style>
</head>
<body>      
	<table width="100%" class="tabla2">
	    <tr>
	        <td width="11%"></td>
	        <td width="37%" class=""><span class="text"></span></td>
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
	        <td align="center" class="fecha"><span class="text">{{ date('d') }}</span></td>
	        <td align="center" class="fecha"><span class="text">{{ date('m') }}</span></td>
	        <td align="center" class="fecha"><span class="text">{{ date('Y') }}</span></td>
	    </tr>
	</table>
	<table width="100%" class="tabla2">
	    <tr>
	        <td width="11%"></td>
	        <td width="37%" class=""><span class="text"> {{ $venta->nombre }}</span></td>
	        <td width="5%">&nbsp;</td>
	        <td width="13%">&nbsp;</td>
	        <td width="4%">&nbsp;</td>
	        <td width="7%" align="center" class=""><strong></strong></td>
	        <td width="8%" align="center" class=""><strong></strong></td>
	        <td width="7%" align="center" class=""><strong></strong></td>
	    </tr>
	    <tr>
	        <td></td>
	        <td class=""><span class="text">{{ $venta->direccion }}</span></td>
	        <td></td>
	        <td class=""><span class="text"></span></td>
	        <td>&nbsp;</td>
	        <td align="center" class=""><span class="text"></span></td>
	        <td align="center" class=""><span class="text"></span></td>
	        <td align="center" class=""><span class="text"></span></td>
	    </tr>
	</table>
	<table width="100%" class="tabla3">
	    <tr>
	    	<td></td>
	    	<td></td>
	    	<td></td>
	    	<td></td>
	       {{-- <td align="center" class="fondo"><strong>CANT.</strong></td>
	        <td align="center" class="fondo"><strong>DESCRIPCIÓN</strong></td>
	        <td align="center" class="fondo"><strong>P. UNITARIO</strong></td>
	        <td align="center" class="fondo"><strong>IMPORTE</strong></td> --}}
	    </tr>
	    @foreach($detalles as $det)		
		    <tr>
		        <td width="7%" align="center"><span class="text">{{ $det->cantidad }}</span></td>
		        <td width="59%"><span class="text">{{ $det->articulo }}</span></td>
		        <td width="16%" align="right"><span class="text">{{ number_format($det->precio_venta, 2, ',', '.') }}</span></td>
		        <td width="18%" align="right"><span class="text">{{ number_format((($det->cantidad*$det->precio_venta)-(($det->cantidad*$det->precio_venta)*($det->descuento/100))), 2, ',', '.') }}</span></td>
		    </tr>
	   	@endforeach
	    <tr>
	        <td style="border:0;">&nbsp;</td>
	        <td style="border:0;">&nbsp;</td>
	        <td align="right"><strong>TOTAL S/.</strong></td>
	        <td align="right"><span class="text">{{ number_format($venta->total_venta, 2, ',', '.') }}</span></td>
	    </tr>
	    <tr>
	        <td style="border:0;">&nbsp;</td>
	        <td align="center" style="border:0;">
	            <table width="200" border="0" cellpadding="0" cellspacing="0">
	                <tr>
	                    <td align="center" class="cancelado"></td>
	                </tr>
	            </table>
	        </td>
	        <td style="border:0;">&nbsp;</td>
	        <td align="center" style="border:0;" class="emisor"><strong></strong></td>
	    </tr>
	</table>
    










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