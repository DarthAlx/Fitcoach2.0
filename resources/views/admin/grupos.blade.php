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
					<div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('grupos')}}" method="post">
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
			  			<form action="{{url('grupos')}}" method="post">
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
			@if ($condominios)
				@foreach ($condominios as $condominio)
	        <div class="teamItem">
	          <a><img src="{{ url('uploads/condominios') }}/{{$condominio->imagen}}" class="img-responsive"></a>
	          <div class="overlay" data-toggle="modal" data-target="#condominio{{$condominio->id}}">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;"><h3>{{ucfirst($condominio->identificador)}}</h3></a>
	            </div>
	            <!--p>Formativa</p-->
	          </div>
	        </div>
	      @endforeach
			@endif
    </div>
  </div>
	</section>




	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>

		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">EVENTOS</div>
				</div>

			</div>
		</div>
		<p>&nbsp;</p>
    <div class="teamItemWrap clear">
			@if ($eventos)
				@foreach ($eventos as $evento)
	        <div class="teamItem">
	          <a><img src="{{ url('uploads/clases') }}/{{$evento->imagenevento}}" class="img-responsive"></a>
	          <div class="overlay" data-toggle="modal" data-target="#evento{{$evento->id}}">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;"><h3>{{ucfirst($evento->nombreevento)}}</h3></a>
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

	@if ($condominios)
		@foreach ($condominios as $condominio)
			<div class="modal fade" id="condominio{{$condominio->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>

			      					<h4>Bienvenido a {{$condominio->identificador}}</h4>
											<p>&nbsp;</p>
											<div class="row">
												<div class="col-sm-4">
															<div class="list-group-item" data-toggle="modal" data-target="#nuevogrupo" style="cursor: pointer;">
																Añadir grupo
															</div>

															<div class="list-group-item" style="cursor: pointer;">
																<a href="{{url('/printgroups')}}/{{$condominio->id}}" target="_blank">Calendario</a>
															</div>
												</div>
												<div class="col-sm-8">
													<h5>Proximas clases</h5>
													<?php $proximas=App\Residencial::where('condominio_id', $condominio->id)->get(); ?>

													<div class="adv-table table-responsive">
												  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
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
																							<a data-toggle="modal" data-target="#grupo{{$proxima->id}}" style="margin: 5px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
																							<a href="#"  onclick="javascript: document.getElementById('botoneliminar{{ $proxima->id }}').click();" style="margin: 5px;"><i class="fa fa-close" aria-hidden="true"></i></a>
																					<form style="display: none;" action="{{ url('/eliminar-grupo') }}" method="post">
										                        {!! csrf_field() !!}
										                        {{ method_field('DELETE') }}
										                        <input type="hidden" name="grupo_id" value="{{ $proxima->id }}">
										                        <input type="submit" id="botoneliminar{{ $proxima->id }}">
										                      </form>

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
													</div>



												</div>
											</div>


			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif









	<div class="modal fade" id="nuevogrupo" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar grupo</h4>
	                <form action="{{ url('/agregar-grupo') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input class="form-control datepicker" type="text" value="{{ old('fecha') }}" placeholder="Fecha" name="fecha" required >
										<input id="horarioNuevo" value="{{ old('hora') }}" class="form-control mitimepicker" placeholder="Hora" type="text" name="hora" required />
										<select class="form-control"  name="user_id" id="coachNuevo" >
                       <option value="">Selecciona un coach</option>
                       @foreach ($coaches as $coach)
                         <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                       @endforeach
                     </select>
										 <select class="form-control"  name="condominio_id" id="clases_idNuevo" >
	                     <option value="">Selecciona un condominio</option>
	                     @foreach ($condominios as $condominio)
	                       <option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
	                     @endforeach
	                   </select>
										 <select class="form-control"  name="clase_id" id="clases_idNuevo" >
	                     <option value="">Selecciona una clase</option>
	                     @foreach ($clases as $clase)
	                       <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
	                     @endforeach
	                   </select>
										<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ old('precio') }}" >
										<select class="form-control"  name="audiencia" id="audiencia" >
											<option value="">Selecciona una audiencia</option>
												<option value="Todos">Todos</option>
												<option value="Adultos">Adultos</option>
												<option value="Adolescentes">Adolescentes</option>
												<option value="Niños">Niños</option>
												<option value="Bebés">Bebés</option>
										</select>
										<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ old('cupo') }}" >

										<textarea name="descripcion" class="form-control" rows="10">Descripción</textarea>


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
											<h4>Actualizar grupo</h4>
											<form action="{{ url('/actualizar-grupo') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
												<input type="hidden" name="_token" value="{{ csrf_token() }}">

												<script type="text/javascript">
												 if (document.getElementById('tipo{{ $grupo->id }}') != null) document.getElementById('tipo{{ $grupo->id }}').value = '{!! $grupo->tipo !!}';
												</script>
												<input class="form-control datepicker" type="text" value="{{ $grupo->fecha }}" placeholder="Fecha" name="fecha" required>
												<input id="horarioNuevo" value="{{ $grupo->hora }}" class="form-control mitimepicker" placeholder="Hora" type="text" name="hora" required/>
												<select class="form-control"  name="user_id" id="user_id{{ $grupo->id }}" >
													 <option value="">Selecciona un coach</option>
													 @foreach ($coaches as $coach)
														 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('user_id{{ $grupo->id }}') != null) document.getElementById('user_id{{ $grupo->id }}').value = '{!! $grupo->user_id !!}';
													</script>
												 <select class="form-control"  name="condominio_id" id="condominio_id{{ $grupo->id }}" >
													 <option value="">Selecciona un condominio</option>
													 @foreach ($condominios as $condominio)
														 <option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('condominio_id{{ $grupo->id }}') != null) document.getElementById('condominio_id{{ $grupo->id }}').value = '{!! $grupo->condominio_id !!}';
													</script>
												 <select class="form-control"  name="clase_id" id="clase_id{{ $grupo->id }}" >
													 <option value="">Selecciona una clase</option>
													 @foreach ($clases as $clase)
														 <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
													 @endforeach
												 </select>
												 <script type="text/javascript">
													if (document.getElementById('clase_id{{ $grupo->id }}') != null) document.getElementById('clase_id{{ $grupo->id }}').value = '{!! $grupo->clase_id !!}';
													</script>
												<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ $grupo->precio }}" >
												<select class="form-control"  name="audiencia" id="audiencia{{ $grupo->id }}" >
													<option value="">Selecciona una audiencia</option>
														<option value="Todos">Todos</option>
														<option value="Adultos">Adultos</option>
														<option value="Adolescentes">Adolescentes</option>
														<option value="Niños">Niños</option>
														<option value="Bebés">Bebés</option>
												</select>
												<script type="text/javascript">
												 if (document.getElementById('audiencia{{ $grupo->id }}') != null) document.getElementById('audiencia{{ $grupo->id }}').value = '{!! $grupo->audiencia !!}';
												 </script>
												<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ $grupo->cupo }}" >

												<textarea name="descripcion" class="form-control" rows="10">{{ $grupo->descripcion }}</textarea>

												<input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
												<div class="text-center">
													<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
													<a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $grupo->id }}').click();">Borrar</a>
												</div>
											</form>
											<form style="display: none;" action="{{ url('/eliminar-grupo') }}" method="post">
												{!! csrf_field() !!}
												{{ method_field('DELETE') }}
												<input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
												<input type="submit" id="botoneliminar{{ $grupo->id }}">
											</form>
										</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif







	@if ($eventos)
		@foreach ($eventos as $evento)
			<div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>

			      					<h4>{{$evento->nombreevento}}</h4>
											<p>&nbsp;</p>
											<div class="row">
												<div class="col-sm-4">
															<div class="list-group-item" style="cursor: pointer;">
																<a href="{{url('/printgroups')}}/{{$evento->id}}" target="_blank">Calendario</a>
															</div>
												</div>
												<div class="col-sm-8">
													<h5>Detalles</h5>


													<div class="adv-table table-responsive">
												  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
												  <thead>
												  <tr>
												      <th>Fecha</th>
												      <th>Cupo</th>
												      <th>Ocupados</th>
												      <th></th>

												  </tr>
												  </thead>
												  <tbody>

													<tr style="cursor: pointer;">
																			      <td>{{$evento->fecha }} {{$evento->hora }}</td>
																			      <td>{{$evento->cupo}}</td>
																			      <td>{{$evento->ocupados}}</td>
																						<td>
																							<a href="{{url('/printlist')}}/{{$evento->id}}" target="_blank" style="margin: 5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>




																						</td>
																			  </tr>

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
													</div>



												</div>
											</div>


			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

@endsection
