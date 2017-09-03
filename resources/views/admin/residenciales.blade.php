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
					<div class="title" style="font-size: 10vw;">GRUPOS</div>
				</div>
				<div class="col-sm-3">
					<div class="buscador">
						<div class="footerSubscribe">
			  			<form>
			  				<input class="" type="text" name="" value="" placeholder="Buscar...">
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
				<a data-toggle="modal" data-target="#nuevogrupo"><img src="{{ url('images') }}/plus.png" class="img-responsive"></a>
				<div class="overlay">
					<div class="teamItemNameWrap">
						<a style="text-decoration:none;" data-toggle="modal" data-target="#nuevogrupo"><h3>Agregar grupo</h3></a>
					</div>
					<!--p>Formativa</p-->
				</div>
			</div>
			@if ($grupos)
				@foreach ($grupos as $grupo)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#grupo{{$grupo->id}}"><img src="{{ url('images') }}/grupos_b.png" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#grupo{{$grupo->id}}"><h3>{{ucfirst($grupo->condominio->identificador)}}</h3></a>
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
	<div class="modal fade" id="nuevogrupo" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar grupo</h4>
	                <form action="{{ url('/agregar-grupo') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input class="form-control datepicker" type="text" value="{{ old('fecha') }}" placeholder="Fecha" name="fecha" required>
										<input id="horarioNuevo" value="{{ old('hora') }}" class="form-control mitimepicker" placeholder="Hora" type="text" name="hora" required/>
										<select class="form-control"  name="user_id" id="coachNuevo" required>
                       <option value="">Selecciona un coach</option>
                       @foreach ($coaches as $coach)
                         <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                       @endforeach
                     </select>
										 <select class="form-control"  name="condominio_id" id="clases_idNuevo" required>
	                     <option value="">Selecciona un condominio</option>
	                     @foreach ($condominios as $condominio)
	                       <option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
	                     @endforeach
	                   </select>
										 <select class="form-control"  name="clase_id" id="clases_idNuevo" required>
	                     <option value="">Selecciona una clase</option>
	                     @foreach ($clases as $clase)
	                       <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
	                     @endforeach
	                   </select>
										<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ old('precio') }}" required>
										<select class="form-control"  name="audiencia" id="audiencia" required>
											<option value="">Selecciona una audiencia</option>
												<option value="Todos">Todos</option>
												<option value="Adultos">Adultos</option>
												<option value="Adolescentes">Adolescentes</option>
												<option value="Niños">Niños</option>
												<option value="Bebés">Bebés</option>
										</select>
										<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ old('cupo') }}" required>
										<select class="form-control"  name="tipo" id="tipo" required>
											<option value="">Selecciona un tipo</option>
											<option value="Clase">Clase</option>
											<option value="Evento">Evento</option>
										</select>
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
												<select class="form-control"  name="user_id" id="user_id{{ $grupo->id }}" required>
		                       <option value="">Selecciona un coach</option>
		                       @foreach ($coaches as $coach)
		                         <option value="{{ $coach->id }}">{{ $coach->name }}</option>
		                       @endforeach
		                     </select>
												 <script type="text/javascript">
                          if (document.getElementById('user_id{{ $grupo->id }}') != null) document.getElementById('user_id{{ $grupo->id }}').value = '{!! $grupo->user_id !!}';
                        	</script>
												 <select class="form-control"  name="condominio_id" id="condominio_id{{ $grupo->id }}" required>
			                     <option value="">Selecciona un condominio</option>
			                     @foreach ($condominios as $condominio)
			                       <option value="{{ $condominio->id }}">{{ $condominio->identificador }}</option>
			                     @endforeach
			                   </select>
												 <script type="text/javascript">
                          if (document.getElementById('condominio_id{{ $grupo->id }}') != null) document.getElementById('condominio_id{{ $grupo->id }}').value = '{!! $grupo->condominio_id !!}';
                        	</script>
												 <select class="form-control"  name="clase_id" id="clase_id{{ $grupo->id }}" required>
			                     <option value="">Selecciona una clase</option>
			                     @foreach ($clases as $clase)
			                       <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
			                     @endforeach
			                   </select>
												 <script type="text/javascript">
                          if (document.getElementById('clase_id{{ $grupo->id }}') != null) document.getElementById('clase_id{{ $grupo->id }}').value = '{!! $grupo->clase_id !!}';
                        	</script>
												<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ $grupo->precio }}" required>
												<select class="form-control"  name="audiencia" id="audiencia{{ $grupo->id }}" required>
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
												<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ $grupo->cupo }}" required>
												<select class="form-control"  name="tipo" id="tipo{{ $grupo->id }}" required>
													<option value="">Selecciona un tipo</option>
													<option value="Clase">Clase</option>
													<option value="Evento">Evento</option>
												</select>
												<script type="text/javascript">
												 if (document.getElementById('tipo{{ $grupo->id }}') != null) document.getElementById('tipo{{ $grupo->id }}').value = '{!! $grupo->tipo !!}';
												 </script>
												<textarea name="descripcion" class="form-control" rows="10">Descripción</textarea>
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

@endsection
