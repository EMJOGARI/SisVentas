@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Nuevao Articulo</h3>
			
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('url'=>'almacen/articulo', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true')) !!}
			{{ Form::token() }}
			<div class="row">	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('codigo', 'Codigo') !!}
	                    {!! Form::text('codigo', null, ['class'=>'form-control', 'value'=>"{{ old('codigo') }}", 'placeholder'=>'Codigo...']) !!}
	                </div>
	            </div>            
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>"{{ old('nombre') }}", 'placeholder'=>'Nombre...']) !!}
	                </div>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('categoria', 'Categoria') !!}
	                    <select name="idcategoria" class="form-control">	                    	
	                    	@foreach ($categorias as $cat)
	                    		<option value="{{ $cat->idcategoria }}">{{ $cat->nombre }}</option>						
							@endforeach	                    	
	                    </select>
	                </div>
	            </div>
	             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('descripcion', 'Descripción') !!}
	                    {!! Form::text('descripcion', null, ['class'=>'form-control', 'value'=>"{{ old('descripcion') }}", 'placeholder'=>'Descripción...']) !!}
	                </div>
	            </div>	            

	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="form-group">
	                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
	                    {!! Form::reset('Cancelar', ['class'=>'btn btn-danger', 'onclick'=>'history.back()']) !!}
	                </div>
	            </div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>


@endsection