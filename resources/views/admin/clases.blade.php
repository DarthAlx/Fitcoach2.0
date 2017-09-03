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
					<div class="title" style="font-size: 10vw;">Clases</div>
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
				<a data-toggle="modal" data-target="#nuevaclase"><img src="{{ url('images') }}/plus.png" class="img-responsive"></a>
				<div class="overlay">
					<div class="teamItemNameWrap">
						<a style="text-decoration:none;" data-toggle="modal" data-target="#nuevaclase"><h3>Agregar clase</h3></a>
					</div>
					<!--p>Formativa</p-->
				</div>
			</div>
			@if ($clases)
				@foreach ($clases as $clase)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#clase{{$clase->id}}"><img src="{{ url('uploads/clases') }}/{{$clase->imagen}}" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#clase{{$clase->id}}"><h3>{{ucfirst($clase->nombre)}}</h3></a>
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
	<div class="modal fade" id="nuevaclase" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar clase</h4>
	                <form action="{{ url('/agregar-clase') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input id="nombreNuevo" class="form-control" type="text" value="{{ old('nombre') }}" placeholder="Nombre" name="nombre" required>
										<select class="form-control"  name="tipo" id="tipoNuevo" required>
	                     <option value="">Selecciona un tipo</option>
	                       <option value="Deportiva">Deportiva</option>
	                       <option value="Cultural">Cultural</option>
	                   </select>
										<input class="form-control" id="imagenNuevo" type="file" name="imagen" required>
										<textarea id="precioNuevo" class="form-control" name="descripcion" placeholder="Descripcion" required>{{ old('descripcion') }}</textarea>
										<input id="precioNuevo" class="form-control" type="text" placeholder="Precio" value="{{ old('precio') }}" name="precio" required>
										<input id="precio_especialNuevo" class="form-control" type="text" placeholder="Precio especial" value="{{ old('precio_especial') }}" name="precio_especial">
	        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
	                </form>
	      				</div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal detalles user -->

	@if ($clases)
		@foreach ($clases as $clase)
			<div class="modal fade" id="clase{{$clase->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Actualizar clase</h4>
			                <form action="{{ url('/actualizar-clase') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input id="nombre{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->nombre }}" name="nombre" required>
												<select class="form-control"  name="tipo" id="tipo{{ $clase->id }}" required>
	                         	<option value="">Selecciona una opción</option>
	                           <option value="Deportiva">Deportiva</option>
	                           <option value="Cultural">Cultural</option>
	                      </select>
				 		 						<script type="text/javascript">
                         if (document.getElementById('tipo{{ $clase->id }}') != null) document.getElementById('tipo{{ $clase->id }}').value = '{!! $clase->tipo !!}';
                       	</script>
												<input class="form-control" type="file" id="imagen{{ $clase->id }}" name="imagen">
												<textarea id="descripcion{{ $clase->id }}" class="form-control" name="descripcion" required>{{ $clase->descripcion }}</textarea>
												<input id="precio{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->precio }}" name="precio" required>
												<input id="precio_especial{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->precio_especial }}" name="precio_especial">
												<input type="hidden" name="clase_id" value="{{ $clase->id }}">
												<div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $clase->id }}').click();">Borrar</a>
                        </div>
			                </form>
											<form style="display: none;" action="{{ url('/eliminar-clase') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="clase_id" value="{{ $clase->id }}">
                        <input type="submit" id="botoneliminar{{ $clase->id }}">
                      </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

@endsection
