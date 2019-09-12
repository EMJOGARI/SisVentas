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
