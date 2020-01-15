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

			{!! Form::model($variables,['method'=>'PUT', 'route'=>['variable_vendedor.update',$variables->idvar]]) !!}
			{{ Form::token() }}
				<div class="row">
					 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				 		<div class="form-group">
					 		{!! Form::label('vendedor', 'Vendedor') !!}
					 		<select name="idvendedor" id="idvendedor" class="form-control selectpicker" data-live-search="true">
		                    	<option value="">Seleccioné un Vendedor</option>
		                    	@foreach($vendedores as $persona)
		                    		<option value="{{ $persona->idpersona }}">{{ str_pad($persona->idpersona, 3, "0", STR_PAD_LEFT).' - '.$persona->nombre }}</option>
		                    	@endforeach
			                </select>
				 		</div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('cuota_venta', 'Cuota de Ventas') !!}
		                    {!! Form::text('cuota_venta', null, ['class'=>'form-control', 'value'=>"{{ old('cuota_venta') }}", 'placeholder'=>'cuota...']) !!}
		                </div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('incentivo_venta', 'Incentivo de Ventas') !!}
		                    {!! Form::text('incentivo_venta', null, ['class'=>'form-control', 'value'=>"{{ old('incentivo_venta') }}", 'placeholder'=>'Incentivo...']) !!}
		                </div>
			        </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('cuota_cliente_activar', 'Cuota Clientes a Activar') !!}
		                    {!! Form::text('cuota_cliente_activar', null, ['class'=>'form-control', 'value'=>"{{ old('cuota_cliente_activar') }}", 'placeholder'=>'Cuota...']) !!}
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="form-group">
		                    {!! Form::label('incentivo_cliente_activar', 'Incentivo Cliente Activados') !!}
		                    {!! Form::text('incentivo_cliente_activar', null, ['class'=>'form-control', 'value'=>"{{ old('incentivo_cliente_activar') }}", 'placeholder'=>'Incentivo...']) !!}
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