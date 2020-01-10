@extends ('layouts.admin')
@section('name', "Editar Valores de Comisiones")
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($variables,['method'=>'PUT', 'route'=>['variable_comision.update',$variables->id_variable]]) !!}
			{{ Form::token() }}
				<div class="row">
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('meta_cumplir', 'Meta a Cumplir') !!}
		                    {!! Form::text('meta_cumplir', null, ['class'=>'form-control', 'value'=>"{{ $variables->meta_cumplir }}", 'placeholder'=>'Meta...']) !!}
		                </div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('objetivo_meta', 'Objetivo Meta a Cumplir') !!}
		                    {!! Form::text('objetivo_meta', null, ['class'=>'form-control', 'value'=>"{{ $variables->objetivo_meta }}", 'placeholder'=>'Objetivo...']) !!}
		                </div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('visita_activa', 'Meta Clientes Activados') !!}
		                    {!! Form::text('visita_activa', null, ['class'=>'form-control', 'value'=>"{{ $variables->visita_activa }}", 'placeholder'=>'Clientes...']) !!}
		                </div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('objetivo_visita', 'Objetivo Meta a Cumplir') !!}
		                    {!! Form::text('objetivo_visita', null, ['class'=>'form-control', 'value'=>"{{ $variables->objetivo_visita }}", 'placeholder'=>'Objetivo...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('comision_max', 'Comision Maxima') !!}
		                    {!! Form::text('comision_max', null, ['class'=>'form-control', 'value'=>"{{ $variables->comision_max }}", 'placeholder'=>'Porcentaje...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('comision_min', 'Comision Minima') !!}
		                    {!! Form::text('comision_min', null, ['class'=>'form-control', 'value'=>"{{ $variables->comision_min }}", 'placeholder'=>'Porcentaje...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('dia_min', 'Dias Minimo') !!}
		                    {!! Form::text('dia_min', null, ['class'=>'form-control', 'value'=>"{{ $variables->dia_min }}", 'placeholder'=>'Dia...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('dia_max', 'Dias Minimo') !!}
		                    {!! Form::text('dia_max', null, ['class'=>'form-control', 'value'=>"{{ $variables->dia_max }}", 'placeholder'=>'Dia...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                <div class="form-group">
		                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
		                	<button class="btn btn-danger" onclick="history.back()" type="reset"><i class="fa fa-close"></i> Cancelar</button>
		                </div>
		            </div>

				</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection