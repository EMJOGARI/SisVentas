@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<h3>Editar Categoria: {{ $categoria->nombre }}</h3>

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($categoria,['method'=>'PUT', 'route'=>['categoria.update',$categoria->idcategoria]]) !!}
			{{ Form::token() }}
			 <div class="row">	            
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'value'=>'{{ $categoria->nombre }}']) !!}
	                </div>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('descripcion', 'Descripcion') !!}
	                    {!! Form::text('descripcion', null, ['class'=>'form-control', 'value'=>'{{ $categoria->descripcion }}']) !!}
	                </div>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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