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
