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
				<div class="col-sm-12">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">GRUPOS</div>
				</div>

			</div>










			<p>&nbsp;</p>
<div class="row">
				<div class="col-sm-12 text-right">
        	<a href="#" class="btn btn-success btn-lg hidden-xs" style="max-width: 200px;" data-toggle="modal" data-target="#nuevogrupo">Agregar grupo</a>
        	<a href="#" class="btn btn-success btn-lg visible-xs" data-toggle="modal" data-target="#nuevogrupo">Agregar grupo</a>
      	</div>
</div>
<p>&nbsp;</p>
 

			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
						<th>Nombre</th>
						<th>Condominio</th>
			  </tr>
			  </thead>
			  <tbody>
					@if ($grupos)
						@foreach ($grupos as $grupo)

									<tr style="cursor: pointer;"  data-toggle="modal" data-target="#grupo{{$grupo->id}}">

								    <td>{{ucfirst($grupo->nombre)}}</td>
								    <td>{{$grupo->condominio->identificador}}</td>
								      
								      
											</tr>
									
								


						@endforeach
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					<th>Nombre</th>
						<th>Condominio</th>


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

	








	<div class="modal fade" id="nuevogrupo" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar grupo</h4>
	                <form action="{{ url('/agregar-grupo') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">

										 <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required>

										 <select class="form-control"  name="condominio_id" id="clases_idNuevo" required>
	                     <option value="">Selecciona un condominio</option>
	                     @foreach ($condominios as $condominio)
	                       <option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
	                     @endforeach
										 </select>

										 <select class="form-control"  name="room_id" id="room_idNuevo" required>
											<option value="">Selecciona un room</option>
											@foreach ($rooms as $room)
											<option value="{{ $room->id }}">{{ $room->nombre }}</option>
											@endforeach
										 </select>
										 <select class="form-control"  name="user_id" id="coachNuevo" required>
												 <option value="">Selecciona un coach</option>
												 @foreach ($coaches as $coach)
													 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
												 @endforeach
											 </select>
												<select class="form-control"  name="clase_id" id="clases_idNuevo" required>
												 <option value="">Selecciona una clase</option>
												 @foreach ($clases as $clase)
													 <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
												 @endforeach
											 </select>
											<select class="form-control"  name="audiencia" id="audiencia" required>
												<option value="">Selecciona una audiencia</option>
												<option value="Todos">Todos</option>
												<option value="Adultos">Adultos</option>
												<option value="Adolescentes">Adolescentes</option>
												<option value="Niños">Niños</option>
												<option value="Bebés">Bebés</option>
											</select>
											<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ old('cupo') }}" required>

											<input type="number" id="tokens" class="form-control" name="tokens" placeholder="Tokens" value="{{ old('tokens') }}" required>

										 <textarea name="descripcion" class="form-control" placeholder="Descripción" rows="10"></textarea>


	        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
	                </form>
	      				</div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal detalles user -->



	@if ($grupos)
		@foreach ($grupos as $grupo)
			<div class="modal fade" id="grupo{{$grupo->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

										<div>
											<a  role="button"  data-toggle="collapse" href="#actualizargrupo{{$grupo->id}}" aria-expanded="false" aria-controls="collapseExample"  class="btn btn-primary">Actualizar grupo</a>
											
											<div class="collapse" id="actualizargrupo{{$grupo->id}}">
											<form action="{{ url('/actualizar-grupo') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
												<input type="hidden" name="_token" value="{{ csrf_token() }}">

												<input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre" value="{{$grupo->nombre or old('nombre') }}" required>

												<select class="form-control"  name="condominio_id" id="condominio_id{{ $grupo->id }}" required>
													<option value="">Selecciona un condominio</option>
													@foreach ($condominios as $condominio)
														<option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
													@endforeach
												</select>
												
										 


												<script type="text/javascript">
												 if (document.getElementById('condominio_id{{ $grupo->id }}') != null) document.getElementById('condominio_id{{ $grupo->id }}').value = '{!! $grupo->condominio_id !!}';
												</script>

												<select class="form-control"  name="room_id" id="room_id{{ $grupo->id }}" required>
											<option value="">Selecciona un room</option>
											@foreach ($rooms as $room)
											<option value="{{ $room->id }}">{{ $room->nombre }}</option>
											@endforeach
										 </select>
										 <script type="text/javascript">
												 if (document.getElementById('room_id{{ $grupo->id }}') != null) document.getElementById('room_id{{ $grupo->id }}').value = '{!! $grupo->room_id !!}';
												</script>

												<select class="form-control"  name="user_id" id="coach{ $grupo->id }}" required>
												 <option value="">Selecciona un coach</option>
												 @foreach ($coaches as $coach)
													 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
												 @endforeach
											 </select>
											 <script type="text/javascript">
												 if (document.getElementById('coach{ $grupo->id }}') != null) document.getElementById('coach{ $grupo->id }}').value = '{!! $grupo->user_id !!}';
												</script>
											<select class="form-control"  name="clase_id" id="clases_id{ $grupo->id }}" required>
												 <option value="">Selecciona una clase</option>
												 @foreach ($clases as $clase)
													 <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
												 @endforeach
											 </select>
											 <script type="text/javascript">
												 if (document.getElementById('clases_id{ $grupo->id }}') != null) document.getElementById('clases_id{ $grupo->id }}').value = '{!! $grupo->clase_id !!}';
												</script>
											<select class="form-control"  name="audiencia" id="audiencia{ $grupo->id }}" required>
												<option value="">Selecciona una audiencia</option>
												<option value="Todos">Todos</option>
												<option value="Adultos">Adultos</option>
												<option value="Adolescentes">Adolescentes</option>
												<option value="Niños">Niños</option>
												<option value="Bebés">Bebés</option>
											</select>
											<script type="text/javascript">
												 if (document.getElementById('audiencia{ $grupo->id }}') != null) document.getElementById('audiencia{ $grupo->id }}').value = '{!! $grupo->audiencia !!}';
												</script>
											<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ $grupo->cupo }}" required>

											<input type="number" id="tokens" class="form-control" name="tokens" placeholder="Tokens" value="{{ $grupo->tokens }}" required>




												<textarea name="descripcion" class="form-control" rows="10">{{ $grupo->descripcion }}</textarea>

												<input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
												<div class="text-center">
													<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
													<a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminargrupo{{ $grupo->id }}').click();">Borrar</a>
												</div>
											</form>
											<form style="display: none;" action="{{ url('/eliminar-grupo') }}" method="post">
												{!! csrf_field() !!}
												{{ method_field('DELETE') }}
												<input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
												<input type="submit" id="botoneliminargrupo{{ $grupo->id }}">
											</form>
											</div>



											<div class="row">
											<div class="col-sm-12">
													<h5>Proximas clases</h5>
													<?php $proximas=App\Horario::where('grupo_id', $grupo->id)->get(); ?>

													<div class="adv-table table-responsive">
												  <table class="display table table-bordered table-striped table-hover" id="dynamic-table2">
												  <thead>
												  <tr>
												      <th>Fecha</th>
												      <th>Clase</th>
												      <th>Coach</th>
												      <th></th>

												  </tr>
												  </thead>
												  <tbody>
														@foreach ($proximas as $proxima)
													
													<tr style="cursor: pointer;">
																			      <td>{{$proxima->fecha }} {{$proxima->hora }}</td>
																			      <td>{{$proxima->clase->nombre }}</td>
																			      <td>{{$proxima->user->name }}</td>
																						<td>
																							<a href="{{url('/printlist')}}/{{$proxima->id}}" target="_blank" style="margin: 5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
																							<a data-toggle="modal" data-target="#horario{{$proxima->id}}" style="margin: 5px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>

																							@if(!$proxima->reservaciones->isEmpty())
																							
																							@else
																							<a href="#"  onclick="javascript: document.getElementById('botoneliminarhorario{{ $proxima->id }}').click();" style="margin: 5px;"><i class="fa fa-close" aria-hidden="true"></i></a>
																							<form style="display: none;" action="{{ url('/eliminar-horariogrupo') }}" method="post">
																		                        {!! csrf_field() !!}
																		                        {{ method_field('DELETE') }}
																		                        <input type="hidden" name="horario_id" value="{{ $proxima->id }}">
																		                        <input type="submit" id="botoneliminarhorario{{ $proxima->id }}">
																		                    </form>
																	                      	@endif

																						</td>
																			  </tr>
																				@endforeach
													</tbody>
																  <tfoot>
																  <tr>
																		<th>Fecha</th>
															      <th>Clase</th>
															      <th>Coach</th>
															      <th></th>
																  </tr>
																  </tfoot>
																	</table>
																	
																	<p>&nbsp;</p>
<div class="row">
				<div class="col-sm-12 text-right">
        	<a href="#" class="btn btn-success btn-lg hidden-xs" style="max-width: 200px;" data-toggle="modal" data-target="#nuevohorario{{$grupo->id}}">Agregar horario</a>
        	<a href="#" class="btn btn-success btn-lg visible-xs" data-toggle="modal" data-target="#nuevohorario{{$grupo->id}}">Agregar horario</a>
      	</div>
</div>
<p>&nbsp;</p>
													</div>



												</div>
												</div>


										</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->





				<div class="modal fade" id="nuevohorario{{$grupo->id}}" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
	
					<div class="modal-body">
	
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
	
									<div>
										<h4>Agregar horario</h4>
										<form action="{{ url('/agregar-horariogrupo') }}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input class="form-control datepicker" type="text" value="{{ old('fecha') }}" placeholder="Fecha" name="fecha" required >
											<input id="horarioNuevo" value="{{ old('hora') }}" class="form-control xmitimepicker" placeholder="Hora" type="text" name="hora" required />
											<input type="hidden" name="user_id" value="{{$grupo->user_id}}">
											<input type="hidden" name="clase_id" value="{{$grupo->clase_id}}">
											<input type="hidden" name="grupo_id" value="{{$grupo->id}}">
											<input type="hidden" name="audiencia" value="{{$grupo->audiencia}}">
											<input type="hidden" name="cupo" value="{{$grupo->cupo}}">
											<input type="hidden" name="tokens" value="{{$grupo->tokens}}">
											
	
											<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
										</form>
									</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal detalles user -->





		@endforeach
	@endif














		@if ($horarios)
		@foreach ($horarios as $horario)
			<div class="modal fade" id="horario{{$horario->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

										<div>
											<h4>Actualizar horario</h4>
											<form action="{{ url('/actualizar-horariogrupo') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
												<input type="hidden" name="_token" value="{{ csrf_token() }}">

												<script type="text/javascript">
												 if (document.getElementById('tipo{{ $horario->id }}') != null) document.getElementById('tipo{{ $horario->id }}').value = '{!! $horario->tipo !!}';
												</script>
												<input class="form-control datepicker" type="text" value="{{ $horario->fecha }}" placeholder="Fecha" name="fecha" required>
												<input id="horarioNuevo" value="{{ $horario->hora }}" class="form-control xmitimepicker" placeholder="Hora" type="text" name="hora" required/>
												<!--select class="form-control"  name="user_id" id="user_id{{ $horario->id }}" >
													 <option value="">Selecciona un coach</option>
													 @foreach ($coaches as $coach)
														 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('user_id{{ $horario->id }}') != null) document.getElementById('user_id{{ $horario->id }}').value = '{!! $horario->user_id !!}';
													</script>
												 <select class="form-control"  name="grupo_id" id="grupo_id{{ $horario->id }}" >
													 <option value="">Selecciona un grupo</option>
													 @foreach ($grupos as $grupo)
														 <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('grupo_id{{ $horario->id }}') != null) document.getElementById('grupo_id{{ $horario->id }}').value = '{!! $horario->grupo_id !!}';
													</script>
												 <select class="form-control"  name="clase_id" id="clase_id{{ $horario->id }}" >
													 <option value="">Selecciona una clase</option>
													 @foreach ($clases as $clase)
														 <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('clase_id{{ $horario->id }}') != null) document.getElementById('clase_id{{ $horario->id }}').value = '{!! $horario->clase_id !!}';
													</script>

												<select class="form-control"  name="audiencia" id="audiencia{{ $horario->id }}" >
													<option value="">Selecciona una audiencia</option>
														<option value="Todos">Todos</option>
														<option value="Adultos">Adultos</option>
														<option value="Adolescentes">Adolescentes</option>
														<option value="Niños">Niños</option>
														<option value="Bebés">Bebés</option>
												</select>
												<script type="text/javascript">
												 if (document.getElementById('audiencia{{ $horario->id }}') != null) document.getElementById('audiencia{{ $horario->id }}').value = '{!! $horario->audiencia !!}';
												 </script>
												<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ $horario->cupo }}" >
												<input type="number" id="tokens" class="form-control" name="tokens" placeholder="Tokens" value="{{ $horario->tokens }}" -->



												<input type="hidden" name="horario_id" value="{{ $horario->id }}">

												@if(!$proxima->reservaciones->isEmpty())
																						<p>Ya existen reservaciones.</p>	
																							@else
												<div class="text-center">
													<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
													<a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminarhorario2{{ $horario->id }}').click();">Borrar</a>
												</div>
												@endif
											</form>
											<form style="display: none;" action="{{ url('/eliminar-horariogrupo') }}" method="post">
												{!! csrf_field() !!}
												{{ method_field('DELETE') }}
												<input type="hidden" name="horario_id" value="{{ $horario->id }}">
												<input type="submit" id="botoneliminarhorario2{{ $horario->id }}">
											</form>
										</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif








@endsection
