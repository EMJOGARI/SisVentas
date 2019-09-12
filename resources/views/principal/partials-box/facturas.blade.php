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

