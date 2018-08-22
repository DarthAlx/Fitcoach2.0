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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">EVENTOS</div>
					<div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('eventos-admin')}}" method="post">
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
			  			<form action="{{url('eventos-admin')}}" method="post">
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
				<div class="overlay" data-toggle="modal" data-target="#nuevoevento">
					<div class="teamItemNameWrap">
						<a style="text-decoration:none;"><h3>Agregar evento</h3></a>
					</div>
					<!--p>Formativa</p-->
				</div>
			</div>
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

<div class="modal fade" id="nuevoevento" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

							<div>
								<h4>Agregar evento</h4>
								<form action="{{ url('/agregar-evento') }}" method="post" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="text" name="nombreevento" placeholder="Nombre" class="form-control" value="" required>
									<input class="form-control" type="file" name="imagenevento"  required>

									<input class="form-control datepicker" type="text" value="{{ old('fecha') }}" placeholder="Fecha" name="fecha" required >
									<input id="horarioNuevo" value="{{ old('hora') }}" class="form-control xmitimepicker" placeholder="Hora" type="text" name="hora" required />
									<select class="form-control"  name="user_id" id="coachNuevo"  required>
										 <option value="">Selecciona un coach</option>
										 @foreach ($coaches as $coach)
											 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
										 @endforeach
									 </select>


									<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ old('precio') }}"  required>

									<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ old('cupo') }}"  required>



									<textarea name="direccionevento" class="form-control" rows="10" placeholder="Dirección" required>Dirección</textarea>

									<textarea name="descripcion" class="form-control" rows="10" placeholder="Descripción" required>Descripción</textarea>

									<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
								</form>
							</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal detalles user -->



@if ($eventos)
	@foreach ($eventos as $evento)
		<div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-body">

									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

									<div>
										<h4>Actualizar evento</h4>
										<form action="{{ url('/actualizar-evento') }}" method="post" enctype="multipart/form-data">
											{{ method_field('PUT') }}
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="text" name="nombreevento" class="form-control" value="{{ $evento->nombreevento }}" required>
											(solo si se desea reemplazar)
											<input class="form-control" type="file" name="imagenevento" >
											<input class="form-control datepicker" type="text" value="{{ $evento->fecha }}" placeholder="Fecha" name="fecha" required>
											<input id="horarioNuevo" value="{{ $evento->hora }}" class="form-control xmitimepicker" placeholder="Hora" type="text" name="hora" required/>
											<select class="form-control"  name="user_id" id="user_id{{ $evento->id }}" required>
												 <option value="">Selecciona un coach</option>
												 @foreach ($coaches as $coach)
													 <option value="{{ $coach->id }}">{{ $coach->name }}</option>
												 @endforeach
											 </select>
											 <script type="text/javascript">
												if (document.getElementById('user_id{{ $evento->id }}') != null) document.getElementById('user_id{{ $evento->id }}').value = '{!! $evento->user_id !!}';
												</script>


											<input type="text" id="precioNuevo" class="form-control" name="precio" placeholder="Precio" value="{{ $evento->precio }}" required>

											<input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo" value="{{ $evento->cupo }}" required>

											<textarea name="direccionevento" class="form-control" rows="10" placeholder="Dirección" required>{!! $evento->direccionevento !!}</textarea>
											<textarea name="descripcion" class="form-control" rows="10" placeholder="Descripción" required>{!! $evento->descripcion !!}</textarea>
											<input type="hidden" name="evento_id" value="{{ $evento->id }}" required>
											<div class="text-center">
												<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
												<a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $evento->id }}').click();">Borrar</a>
											</div>
										</form>
										<form style="display: none;" action="{{ url('/eliminar-evento') }}" method="post">
											{!! csrf_field() !!}
											{{ method_field('DELETE') }}
											<input type="hidden" name="evento_id" value="{{ $evento->id }}">
											<input type="submit" id="botoneliminar{{ $evento->id }}">
										</form>
									</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal detalles user -->
	@endforeach
@endif

@endsection
