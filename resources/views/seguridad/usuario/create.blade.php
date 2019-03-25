 @extends ('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<h3>Nuevo Usuario</h3>
			
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('url'=>'seguridad/usuario', 'method'=>'POST', 'autocomplete'=>'off',)) !!}
			{{ Form::token() }}
			<div class="row">

	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}   
                        <div>                 
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('tipo_persona', 'Tipo Usuario') !!}
                        <select name="idrol" class="form-control"> 
                            @foreach($usuarios as $u)
                                <option value="{{ $u->idrol }}">{{ $u->tipo }}</option>
                            @endforeach                          
                        </select>                        
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('email', 'E-Mail') !!} 
                        <div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                    
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        <div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                        
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('password-confirm', 'Confirmar Password') !!}
                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
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