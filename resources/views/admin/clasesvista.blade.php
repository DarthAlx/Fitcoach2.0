@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="row profile">
	      <div class="col-sm-12">
	        @include('holders.notificaciones')
	      </div>
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-9">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">CLASES</div>
				</div>

			</div>
			<p>&nbsp;</p><p>&nbsp;</p>
			<div class="row">

				<form action="{{url('clasesvista')}}" method="post">
					{!! csrf_field() !!}
					<div class=" col-sm-3 col-md-2 col-md-offset-4">
						<select class="form-control" name="status" id="status">
							<option value="*">Todas</option>
							<option value="Proxima">Proxima</option>
							<option value="Cancelada">Cancelada</option>
							<option value="Porrevisar">Por revisar</option>
							<option value="Completa">Completada</option>
						</select>
						<script type="text/javascript">
							document.getElementById('status').value='{!!$status!!}';
						</script>
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="text" class="form-control datepicker" name="from" placeholder="Desde..." value="{{$from}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="text" class="form-control datepicker" name="to" placeholder="Hasta..." value="{{$to}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="submit" value="Ver periodo" class="btn btn-success">
					</div>
				</form>
			</div>

			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			
						<th>Fecha de clase</th>

			      <th>Clase</th>
			      <th>Coach</th>
			      <th>Status</th>
			      <th>Aforo</th>
			      <th>Abono</th>
				  <th>Acciones</th>
			  </tr>
			  </thead>
			  <tbody>
<?php $array=array(); ?>
					@if ($clases)
						@foreach ($clases as $clase)
							@if ($clase->tipo=="residencial")
								@if (in_array($clase->nombre.$clase->fecha.$clase->hora,$array))

									<!--clase ya mostrada, no se hace nada-->
								@else
									<tr style="cursor: pointer;">
								    
											<td>{{$clase->fecha}} {{$clase->hora}}</td>

								      <td>{{$clase->nombre}}</td>
								      <td>
												<?php
															$coach=App\User::find($clase->coach_id);

												?>


													{{$coach->name}}


											</td>
								      <td>{{$clase->status}} {{$clase->metadata}}</td>
								      <td>
								      	@if($clase->aforo!=null)
								      	{{$clase->aforo}}
								      	@else
								      	-
								      	@endif
								      </td>
								      <td>
								      	@if($clase->abono)
								      	${{$clase->abono->abono}} MXN
								      	@else
								      	-
								      	@endif
								      </td>
								      
											<td>
												<button type="button" class="btn btn-default" name="button" data-toggle="modal" data-target="#clase{{$clase->id}}">Clase</button>
												@if($clase->status!="COMPLETA"&&$clase->metadata!="cupon enviado"&&$clase->metadata!="abonada a coach")
													<button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#completar{{$clase->id}}">Completar</button>
													<button type="button" class="btn btn-danger" name="button" data-toggle="modal" data-target="#cancelar{{$clase->id}}">Cancelar</button>
												@endif
											</td>
								  </tr>
									<?php $array[]=$clase->nombre.$clase->fecha.$clase->hora; ?>
								@endif

						@else
							<tr style="cursor: pointer;">
						     
									<td>{{$clase->fecha}} {{$clase->hora}}</td>

						      <td>{{$clase->nombre}}</td>
						      <td>
										<?php
													$coach=App\User::find($clase->coach_id);

										?>


											{{$coach->name}}


									</td>
						      <td>{{$clase->status}} {{$clase->metadata}}
									</td>
									<td>
								      	@if($clase->aforo!=null)
								      	{{$clase->aforo}}
								      	@else
								      	-
								      	@endif
								      </td>
									<td>
								      	@if($clase->abono)
								      	{{$clase->abono->abono}}
								      	@else
								      	-
								      	@endif
								      </td>

									<td>
										<button type="button" class="btn btn-default" name="button" data-toggle="modal" data-target="#clase{{$clase->id}}">Clase</button>
										@if($clase->status!="COMPLETA"&&$clase->metadata!="token devuelto"&&$clase->metadata!="abonada a coach")
											<button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#completar{{$clase->id}}">Completar</button>
											<button type="button" class="btn btn-danger" name="button" data-toggle="modal" data-target="#cancelar{{$clase->id}}">Cancelar</button>
										@endif
									</td>
						  </tr>
							@endif
						@endforeach
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					
					<th>Fecha de clase</th>

					<th>Clase</th>
					<th>Coach</th>
					<th>Status</th>
					<th>Aforo</th>
					<th>Abono</th>
					<th>Acciones</th>
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


	@if ($clases)
		@foreach ($clases as $clase)
			<div class="modal fade" id="clase{{$clase->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
										<h4 class="title">{{$clase->id}}: {{$clase->nombre}}</h4>
										<div class="row">
											<div class="col-sm-5">
				      					<p>
				      						<strong>Fecha: </strong> {{$clase->fecha}}<br>
													<strong>Lugar: </strong> {{$clase->direccion}}<br>
													<strong>Tipo: </strong> {{$clase->tipo}}<br>
													@if ($clase->tipo=="residencial")

													@else
														<strong>Cliente: </strong> @if ($clase->user){{$clase->user->name}}@else
															<p>No existe el usuario</p>
														@endif<br>
													@endif
													<strong>Teléfono: </strong> @if ($clase->user){{$clase->user->tel}}@else
														<p>No existe el usuario</p>
													@endif<br>

													<?php
																$coach=App\User::find($clase->coach_id);
																$calificacion=App\Rating::where('reservacion_id', $clase->id)->first();
																if ($calificacion) {
																	$promedio=$calificacion->rate;
																}
																else {
																	$promedio="Sin rating";
																}

													?>


														<strong>Rating: </strong> {{$promedio}}
				      					</p>

				      				</div>
											<div class="col-sm-7">
												<form action="{{ url('/comentarios') }}" method="post">
														{{ method_field('PUT') }}
				        						<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="orden_id" value="{{$clase->id}}">
														<textarea rows="8" cols="80" class="form-control" name="comentarios" placeholder="Comentarios" required>{{$clase->comentarios}}</textarea>
				        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
				                </form>
											</div>
										</div>

			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal contraseña -->
		@endforeach
	@endif



	@if ($clases)
		@foreach ($clases as $clase)
			<div class="modal fade" id="completar{{$clase->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
										<h4 class="title">Abonar</h4>
										<?php $coach=App\User::find($clase->coach_id); ?>
										<p>{{$coach->name}}</p>
										<div class="row">

											<div class="col-sm-12">
												<form action="{{ url('/abonar') }}" method="post">
													<label for="">¿Cuanto quieres abonar?</label>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="user_id" value="{{ $coach->id }}">
													<input type="hidden" name="reservacion_id" value="{{ $clase->id }}">
													<input type="number" name="abono" class="form-control" placeholder="Abono" required>
													<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Completar</button>
												</form>
											</div>
										</div>

						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal contraseña -->
		@endforeach
	@endif

	@if ($clases)
		@foreach ($clases as $clase)
			<div class="modal fade" id="cancelar{{$clase->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
										<h4 class="title">Cancelar</h4>
										<?php $coach=App\User::find($clase->coach_id); ?>
										<p>{{$clase->nombre}}</p>
										<div class="row">

											<div class="col-sm-12">
												<form action="{{ url('/cancelar') }}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="user_id" value="{{ $coach->id }}">
													<input type="hidden" name="orden_id" value="{{ $clase->id }}">
													<input type="hidden" name="id" value="{{ $clase->id }}">
													<select class="form-control" name="tipocancelacion" required>
														<option value="">Tipo de cancelación</option>
														<option value="token">Token</option>
														<option value="abono">Abonar</option>
													</select>
													<input type="text" name="abono" class="form-control" placeholder="Abono/Tokens" required>
													<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Completar</button>
												</form>
											</div>
										</div>

						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal contraseña -->
		@endforeach
	@endif


@endsection
