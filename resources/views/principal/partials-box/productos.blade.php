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
    <a href="{{ url('reporte/almacen/resumen-inventario') }}" class="small-box-footer">
      Mas info <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>