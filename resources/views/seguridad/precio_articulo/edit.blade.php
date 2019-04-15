@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Editar Articulo: {{ $articulos->nombre }}</h3>

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($articulos,['method'=>'PUT', 'route'=>['precio_articulo.update',$articulos->idarticulo], 'file'=>'true']) !!}
			{{ Form::token() }}
			<div class="row">	
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('codigo', 'Codigo') !!}
	                    {!! Form::text('codigo', null, ['class'=>'form-control', 'value'=>'{{ $articulos->codigo }}', 'disabled']) !!}
	                </div>
	            </div>            
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>'{{ $articulos->nombre }}', 'disabled']) !!}
	                </div>
	            </div>

	            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('stock', 'Stock') !!}
	                    {!! Form::text('stock', null, ['class'=>'form-control', 'value'=>'{{ $articulos->stock }}', 'disabled']) !!}
	                </div>
	            </div>
	           
	           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('precio_venta', 'Nombre') !!}
	                    {!! Form::text('precio_venta', null, ['class'=>'form-control', 'value'=>'{{ $articulos->precio_venta }}']) !!}
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