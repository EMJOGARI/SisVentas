@extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<h3>Editar Usuario: {{ $usuario->name }}</h3>

			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($usuario,['method'=>'PUT', 'route'=>['usuario.update',$usuario->id]]) !!}
			{{ Form::token() }}
			 <div class="row">	            
	            <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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