@extends ('layouts.admin')
@section('name', "Nueva Persona")
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

			{!! Form::open(array('url'=>'seguridad/variable_comision', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{ Form::token() }}
			<div class="row">
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('meta_cumplir', 'Meta a Cumplir') !!}
	                    {!! Form::text('meta_cumplir', null, ['class'=>'form-control', 'value'=>"{{ old('meta_cumplir') }}", 'placeholder'=>'Meta...']) !!}
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('objetivo_meta', 'Objetivo Meta a Cumplir') !!}
	                    {!! Form::text('objetivo_meta', null, ['class'=>'form-control', 'value'=>"{{ old('objetivo_meta') }}", 'placeholder'=>'Objetivo...']) !!}
	                </div>
		        </div>

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('comision_max', 'Comision Maxima') !!}
	                    {!! Form::text('comision_max', null, ['class'=>'form-control', 'value'=>"{{ old('comision_max') }}", 'placeholder'=>'Porcentaje...']) !!}
	                </div>
	            </div>

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('comision_min', 'Comision Minima') !!}
	                    {!! Form::text('comision_min', null, ['class'=>'form-control', 'value'=>"{{ old('comision_min') }}", 'placeholder'=>'Porcentaje...']) !!}
	                </div>
	            </div>

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('dia_min', 'Dias Minimo') !!}
	                    {!! Form::text('dia_min', null, ['class'=>'form-control', 'value'=>"{{ old('dia_min') }}", 'placeholder'=>'Dia...']) !!}
	                </div>
	            </div>

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('dia_max', 'Dias Minimo') !!}
	                    {!! Form::text('dia_max', null, ['class'=>'form-control', 'value'=>"{{ old('dia_max') }}", 'placeholder'=>'Dia...']) !!}
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