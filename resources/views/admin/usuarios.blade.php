@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-12">
        	@include('holders.notificaciones')
      	</div>
				<div class="col-sm-12">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">USUARIOS</div>
					<div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('admins')}}" method="post">
					      {!! csrf_field() !!}
					      <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
					      <button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
					    </form>
					  </div>

					</div>
				</div>
				<div class="col-sm-3 visible-xs">
					<div class="buscador">
						<div class="footerSubscribe">
			  			<form action="{{url('admins')}}" method="post">
								{!! csrf_field() !!}
			  				<input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
								<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  			</form>
			  		</div>

					</div>
				</div>
			</div>
		</div>
		<p>&nbsp;</p>
    <div class="teamItemWrap clear">
			<div class="teamItem">
				<a><img src="{{ url('images') }}/plus.png" class="img-responsive"></a>
				<div class="overlay" data-toggle="modal" data-target="#nuevoadmin">
					<div class="teamItemNameWrap">
						<a style="text-decoration:none;"><h3>Agregar administrador</h3></a>
					</div>
					<!--p>Formativa</p-->
				</div>
			</div>
			@if ($usuarios)
				@foreach ($usuarios as $usuario)
	        <div class="teamItem">
	          <a><img src="{{ url('images') }}/usuarios_b.png" class="img-responsive"></a>
	          <div class="overlay" data-toggle="modal" data-target="#admin{{$usuario->id}}">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;"><h3>{{ucfirst($usuario->name)}}</h3></a>
	            </div>
	            <!--p>Formativa</p-->
	          </div>
	        </div>
	      @endforeach
			@endif
    </div>
  </div>
	</section>
@endsection

@section('modals')

	<div class="modal fade" id="nuevoadmin" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar administrador</h4>
	                <form action="{{ url('/agregar-admin') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
										<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
										<input class="form-control datepicker" type="text" value="{{ old('dob') }}" placeholder="Fecha de nacimiento" name="dob" required>
										<input type="tel" class="form-control" name="tel" value="{{ old('tel') }}" placeholder="Teléfono" required>
										<select class="form-control" name="genero" value="{{ old('genero') }}" required>
											<option value="">Genero</option>
											<option value="Masculino">Masculino</option>
											<option value="Femenino">Femenino</option>
										</select>



												 <div class="form-group permisoscont" >
                            <label class="control-label">Permisos</label>
															@foreach ($modulos as $modulo)
					                       <div class="checkbox">
					                        <label>
					                          <input type='checkbox' class="permisos" name="permisos[]"  value="{{$modulo->nombre}}">{{ ucfirst($modulo->nombre) }}
					                        </label>
					                       </div>
					                    @endforeach
														</div>
										<input type="password" class="form-control" name="password" placeholder="Contraseña" required>
										<input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña" required>
	        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
	                </form>
	      				</div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal detalles user -->



	@if ($usuarios)
		@foreach ($usuarios as $admin)
			<div class="modal fade" id="admin{{$admin->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Actualizar admin</h4>
			                <form action="{{ url('/actualizar-admin') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="text" class="form-control" name="name" value="{{$admin->name}}" placeholder="Nombre" required>
												<input type="email" class="form-control" name="email" value="{{$admin->email}}" placeholder="Email" required>
												<input class="form-control datepicker" type="text" value="{{$admin->dob}}" placeholder="Fecha de nacimiento" name="dob" required>
												<input type="tel" class="form-control" name="tel" value="{{$admin->tel}}" placeholder="Teléfono" required>
												<select class="form-control" name="genero" id="genero{{ $admin->id }}" required>
													<option value="">Genero</option>
													<option value="Masculino">Masculino</option>
													<option value="Femenino">Femenino</option>
												</select>
												<script type="text/javascript">
												 if (document.getElementById('genero{{ $admin->id }}') != null) document.getElementById('genero{{ $admin->id }}').value = '{!! $admin->genero !!}';
												 </script>



		 												 <div class="form-group permisoscont{{ $admin->id }}">
		                             <label class="control-label">Permisos</label>
		 															@foreach ($modulos as $modulo)
																		<div class="checkbox">
																		 <label>
																			 <input type='checkbox' class="permisos" name="permisos[]" id="check{{$admin->id}}{{$modulo->id}}"  value="{{$modulo->nombre}}">{{ ucfirst($modulo->nombre) }}
																		 </label>
																		</div>
		 					                    @endforeach
		 														</div>



												@if ($admin->detalles)
														<?php
															$permisos = explode(',',$admin->detalles->permisos);
														 ?>
														<script type="text/javascript">
															@foreach ($permisos as $permiso)
																document.getElementById('check{{$admin->id}}{{$permiso}}').checked = true;
															@endforeach
														</script>
												@endif


												<input type="password" class="form-control" name="password" placeholder="Contraseña">
												<input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña">
												<input type="hidden" name="admin_id" value="{{ $admin->id }}">
												<div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $admin->id }}').click();">Borrar</a>
                        </div>
			                </form>
											<form style="display: none;" action="{{ url('/eliminar-admin') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                        <input type="submit" id="botoneliminar{{ $admin->id }}">
                      </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif



@endsection
