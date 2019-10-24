@extends ('layouts.admin')
@section('name', "Modificar Articulo")
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Articulo: {{ $articulos->nombre }}</h3>

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
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>'{{ $articulos->nombre }}', 'disabled']) !!}
	                </div>
	            </div>

	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('stock', 'Stock') !!}
	                    {!! Form::text('stock', null, ['class'=>'form-control', 'value'=>'{{ $articulos->stock }}']) !!}
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('precio_compra', 'Costo') !!}
	                    {!! Form::text('precio_compra', null, ['class'=>'form-control', 'value'=>'{{ $articulos->precio_compra }}']) !!}
	                </div>
	            </div>
				 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('precio_venta_actual', 'Precio de Venta Actual') !!}
	                    {!! Form::text('precio_venta_actual', null, ['class'=>'form-control', 'value'=>'{{ $articulos->precio_venta_actual }}', 'disabled']) !!}
	                </div>
	            </div>
	           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                	{!! Form::label('precio_venta', 'Precio de Venta') !!}
	                	<div class="input-group">
	                        <span class="input-group-addon">
								{!! Form::checkbox('up_precio_venta') !!}
	                        </span>

	                    	{!! Form::text('precio_venta', null, ['class'=>'form-control', 'value'=>'{{ $articulos->precio_venta }}']) !!}
	                  	</div>
	                    {{--
	                    {!! Form::text('precio_venta', null, ['class'=>'form-control', 'value'=>'{{ $articulos->precio_venta }}']) !!}--}}
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