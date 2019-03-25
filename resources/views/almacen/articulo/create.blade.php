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
	            	{!! Form::label('categoria', 'Categoria') !!}
	                <div class="input-group"> 
	                    <select name="idcategoria" class="form-control" name="reload_categoria" id="reload_categoria">
	                    	<option value="">Selecciona una Categoria</option>	                    	
	                    	@foreach ($categorias as $cat)
	                    		<option value="{{ $cat->idcategoria }}">{{ $cat->nombre }}</option>						
							@endforeach                    	
	                    </select>
		                <div class="input-group-btn">
		                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Nuevo</button>
		                </div>
	                </div> 
	            </div> 
             	
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 2rem;">
	                <div class="form-group">
	                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                	<button class="btn btn-danger" onclick="location.href='{{ url('almacen/articulo/') }}'" type="reset"><i class="fa fa-close"></i> Cancelar</button>
	                </div>
	            </div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>



{{--MODAL--}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    	{!! Form::open(array('url'=>'almacen/categoria', 'method'=>'POST', 'autocomplete'=>'off',)) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Nueva Categoria</h4>
            </div>
            <div class="modal-body">
            
			{{ Form::token() }}
			 <div class="row">	            
	            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
	                <div class="form-group">
	                    {!! Form::label('nombre', 'Nombre') !!}
	                    {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre...']) !!}
	                </div>
	            </div>	            
	            
			</div>
			
            </div>
            <div class="modal-footer">
                <div class="form-group">
	                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                	<button class="btn btn-danger" onclick="location.href='{{ url('almacen/articulo/create') }}'" type="reset"><i class="fa fa-close"></i> Cancelar</button>
	                </div>
            </div>
        </div>
            <!-- /.modal-content -->
            {!! Form::close() !!}
    </div>
          <!-- /.modal-dialog -->
</div>
@endsection