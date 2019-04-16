@extends ('layouts.admin')
@section('content')
<diw class="row">	
	<div class="col-md-3">
      	<div class="small-box bg-purple">
            <div class="inner">            	
            	@foreach($articulos as $art)
            		<h3>{{ $art->total }}</h3>
				@endforeach
              	<p class="info-box-text">Productos en stock</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="{{ url('almacen/articulo/') }}" class="small-box-footer">
              Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3"> 
        <div class="small-box bg-green">
            <div class="inner">            	
            	@foreach($ventas as $ven)
            		<h3>{{ $ven->ventas }}</h3>
				@endforeach
              	<p class="info-box-text">Facturas emitidas</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="{{ url('ventas/venta') }}" class="small-box-footer">
              Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
	</div>

	<div class="col-md-3">		
        <div class="small-box bg-yellow">
            <div class="inner">            	
            	@foreach($ingresos as $ing)
            		<h3>{{ $ing->ingresos }}</h3>
				@endforeach
              	<p class="info-box-text">Compras realizadas</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{ url('compras/ingreso/') }}" class="small-box-footer">
              Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
	</div>

	<div class="col-md-3">
		<div class="small-box bg-aqua">
            <div class="inner">
            	@foreach($personas as $per)	
          			<h3>{{ $per->personas }}</h3>
				@endforeach 
              <p class="info-box-text">Clientes Registrados</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-users"></i>
            </div>
            <a href="{{ url('seguridad/persona') }}" class="small-box-footer">
              Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>		   	
	</div>
	


</diw>

	
@endsection