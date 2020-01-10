@extends ('layouts.admin')
@section('name', "Variables de Comisiones")
@section('content')

	<div class="row">
		@foreach($variables as $var)
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="small-box bg-green">
		            <div class="inner">
		              	<h3>{{ number_format($var->meta_cumplir, 2, ',', '.') }}<sup style="font-size: 20px">Bs.</sup></h3>
		              	<p class="info-box-text"><strong>Meta a cumplir en el mes</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>

	        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="small-box bg-green">
		            <div class="inner">
		              	<h3>{{ number_format($var->objetivo_meta, 2, ',', '.') }}<sup style="font-size: 20px">Bs.</sup></h3>
		              	<p class="info-box-text"><strong>objetivo Meta cumplida</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>

	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="small-box bg-green">
		            <div class="inner">
		              	<h3>{{ number_format($var->visita_activa, 0, ',', '.') }}<sup style="font-size: 20px"></sup></h3>
		              	<p class="info-box-text"><strong>Meta clientes visitados</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>

	        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="small-box bg-green">
		            <div class="inner">
		              	<h3>{{ number_format($var->objetivo_visita, 2, ',', '.') }}<sup style="font-size: 20px">Bs.</sup></h3>
		              	<p class="info-box-text"><strong>Objetivo clientes visitados</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>


	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	        	<div class="small-box 	@if ( $var->comision_max == 0)
	        	 							bg-red
										@else
											bg-aqua
										@endif ">
			            <div class="inner">
			              	<h3>{{ number_format($var->comision_max, 0, ',', '.')}}<sup style="font-size: 20px">%</sup></h3>
			              	<p class="info-box-text"><strong>comisiones maximas</strong></p>
			            </div>
			            <div class="icon">
			              <i class="fa fa-bar-chart"></i>
			            </div>
			            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
			              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
			            </a>
			        </div>



	        </div>
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="small-box 	@if ( $var->comision_min == 0)
	        	 							bg-red
										@else
											bg-aqua
										@endif ">
		            <div class="inner">
		              	<h3>{{ number_format($var->comision_min, 0, ',', '.') }}<sup style="font-size: 20px">%</sup></h3>
		              	<p class="info-box-text"><strong>comisiones minimas</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="small-box 	@if ( $var->dia_min == 0)
	        	 							bg-red
										@else
											bg-aqua
										@endif ">
		            <div class="inner">
		              	<h3>{{ $var->dia_min }}<sup style="font-size: 20px"></sup></h3>
		              	<p class="info-box-text"><strong>Dias Minimos para Pago</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="small-box 	@if ( $var->dia_max == 0)
	        	 							bg-red
										@else
											bg-aqua
										@endif ">
		            <div class="inner">
		              	<h3>{{ $var->dia_max }}<sup style="font-size: 20px"></sup></h3>
		              	<p class="info-box-text"><strong>Dias maximos para Pago</strong></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="{{ URL::action('VariableController@edit',$var->id_variable) }}" class="small-box-footer">
		              	Editar Valores <i class="fa fa-arrow-circle-right"></i>
		            </a>
		        </div>
	        </div>

			<!-- /.info-box -->

        @endforeach

	</div>
@endsection