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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">COACHES</div>
					<!--div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('coaches')}}" method="post">
					      {!! csrf_field() !!}
					      <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
					      <button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
					    </form>
					  </div>

					</div-->
				</div>
				<!--div class="col-sm-3 visible-xs">
					<div class="buscador">
						<div class="footerSubscribe">
			  			<form action="{{url('coaches')}}" method="post">
								{!! csrf_field() !!}
			  				<input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
								<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  			</form>
			  		</div>

					</div>
				</div-->
			</div>
		












<p>&nbsp;</p>
<div class="row">
				<div class="col-sm-12 text-right">
        	<a href="#" class="btn btn-success btn-lg hidden-xs" style="max-width: 200px;" data-toggle="modal" data-target="#nuevoadmin">Agregar Usuario</a>
        	<a href="#" class="btn btn-success btn-lg visible-xs" data-toggle="modal" data-target="#nuevoadmin">Agregar Usuario</a>
      	</div>
</div>
<p>&nbsp;</p>
 

			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			<th>Nombre</th>
						<th><i class="fa fa-picture-o"></i></th>

			      
			      <th>Email</th>
			      <th>Teléfono</th>
			      <th>Último acceso</th>


			  </tr>
			  </thead>
			  <tbody>
					@if ($usuarios)
						@foreach ($usuarios as $usuario)

									<tr style="cursor: pointer;"  data-toggle="modal" data-target="#admin{{$usuario->id}}">

								    <td>{{ucfirst($usuario->name)}}</td>
											<td>
												@if($usuario->detalles->photo!="")
												 <img src="{{ url('uploads/avatars') }}/{{ $usuario->detalles->photo }}" class="img-responsive" style="max-width: 50px;">
												@else
												 <img src="{{ url('uploads/avatars') }}/dummy.png" alt="" class="img-responsive" style="max-width: 50px;">
												@endif
												
											</td>

								      
								      <td>{{$usuario->email}}</td>
								       <td>{{$usuario->tel}}</td>
								      <td>{{$usuario->acceso}}</td>
								      
								      
											</tr>
									
								


						@endforeach
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					<th>Nombre</th>
				<th><i class="fa fa-picture-o"></i></th>

			      
			      <th>Email</th>
			      <th>Teléfono</th>
			      <th>Último acceso</th>


			  </tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
		</div>
		<p>&nbsp;</p>

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
	      					<h4>Agregar coach</h4>
	                <form action="{{ url('/agregar-coach') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
										<input class="form-control" type="file"  name="photo">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
										<input class="form-control datepicker" type="text" value="{{ old('dob') }}" placeholder="Fecha de nacimiento" name="dob" required>
										<input type="tel" class="form-control" name="tel" value="{{ old('tel') }}" placeholder="Teléfono" required>
										<select class="form-control" name="genero" value="{{ old('genero') }}" required>
											<option value="">Genero</option>
											<option value="Masculino">Masculino</option>
											<option value="Femenino">Femenino</option>
										</select>


												<div class="form-group permitidascont">
                           <label class="control-label">Clases permitidas</label>
													 <?php $clases = App\Clase::orderBy('nombre', 'asc')->get(); ?>
                             @foreach ($clases as $clase)
                               <div class="checkbox">
                                <label>
                                  <input type='checkbox' class="permitidas" name="clases[]"  value="{{$clase->id}}">{{ $clase->nombre }}
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
											<h4>Actualizar coach</h4>
											@if($admin->documentacion)
											@if($admin->documentacion->rfc!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->rfc}}" class="btn btn-default">RFC</a> &nbsp; @endif
											@if($admin->documentacion->ine!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->ine}}" class="btn btn-default">INE</a> &nbsp; @endif
											@if($admin->documentacion->curp!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->curp}}" class="btn btn-default">CURP</a> &nbsp; @endif
											@if($admin->documentacion->acta!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->acta}}" class="btn btn-default">Acta</a> &nbsp; @endif
											@if($admin->documentacion->domicilio!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->domicilio}}" class="btn btn-default">Comprobante</a> &nbsp; @endif
											@if($admin->documentacion->certificaciones!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->certificaciones}}" class="btn btn-default">Certificaciones</a> &nbsp; @endif
											@if($admin->documentacion->recomendacion1!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->recomendacion1}}" class="btn btn-default">CR1</a> &nbsp; @endif
											@if($admin->documentacion->recomendacion2!="")<a target="_blank" download href="{{url('uploads/documentos')}}/{{$admin->documentacion->recomendacion2}}" class="btn btn-default">CR2</a> &nbsp; @endif
											<p>&nbsp;</p>
											@else
											<p>El coach aún no envía documentación.</p>
											@endif
			                <form action="{{ url('/actualizar-coach') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="text" class="form-control" name="name" value="{{$admin->name}}" placeholder="Nombre" required>
												<label for="">Solo si se desea reemplazar</label>
												<input class="form-control" type="file"  name="photo">
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

		 												<div class="form-group permitidascont{{ $admin->id }}">
		                            <label class="control-label">Clases permitidas</label>
		 													 <?php $clases = App\Clase::orderBy('nombre', 'asc')->get(); ?>
		                              @foreach ($clases as $clase)
		                                <div class="checkbox">
		                                 <label>
		                                   <input type='checkbox' class="permitidas" id="permitidas{{$admin->id}}{{$clase->id}}"  name="clases[]"  value="{{$clase->id}}">{{ $clase->nombre }}
		                                 </label>
		                                </div>
		                              @endforeach
		                          </div>




												@if ($admin->detalles)
														<?php
															$permitidas = explode(',',$admin->detalles->clases);

														 ?>
														<script type="text/javascript">
															@foreach ($permitidas as $permitida)

																document.getElementById('permitidas{{$admin->id}}{{$permitida}}').checked = true;
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
											<form style="display: none;" action="{{ url('/eliminar-coach') }}" method="post">
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
