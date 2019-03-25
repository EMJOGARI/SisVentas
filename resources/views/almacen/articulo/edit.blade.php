@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Editar Articulo: {{ $articulo->nombre }}</h3>

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($articulo,['method'=>'PUT', 'route'=>['articulo.update',$articulo->idarticulo], 'file'=>'true']) !!}
			{{ Form::token() }}
			<div class="row">	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('codigo', 'Codigo') !!}
	                    {!! Form::text('codigo', null, ['class'=>'form-control', 'value'=>'{{ $articulo->codigo }}']) !!}
	                </div>
	            </div>            
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>'{{ $articulo->nombre }}']) !!}
	                </div>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('categoria', 'Categoria') !!}
	                    <select name="idcategoria" class="form-control">
	                    	<option value="#">Agregar Categoria</option>
	                    	@foreach ($categorias as $cat)
	                    		@if ($cat->idcategoria==$articulo->idcategoria)
	                    			<option value="{{ $cat->idcategoria }}" selected>{{ $cat->nombre }}</option>
	                    		@else
									<option value="{{ $cat->idcategoria }}">{{ $cat->nombre }}</option>
								@endif
							@endforeach	                    	
	                    </select>
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