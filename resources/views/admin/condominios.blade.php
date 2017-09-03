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
					<div class="title" style="font-size: 10vw;">CONDOMINIOS</div>
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
				<a data-toggle="modal" data-target="#nuevocondominio"><img src="{{ url('images') }}/plus.png" class="img-responsive"></a>
				<div class="overlay">
					<div class="teamItemNameWrap">
						<a style="text-decoration:none;" data-toggle="modal" data-target="#nuevocondominio"><h3>Agregar condominio</h3></a>
					</div>
					<!--p>Formativa</p-->
				</div>
			</div>
			@if ($condominios)
				@foreach ($condominios as $condominio)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#condominio{{$condominio->id}}"><img src="{{ url('uploads/condominios') }}/{{$condominio->imagen}}" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#condominio{{$condominio->id}}"><h3>{{ucfirst($condominio->identificador)}}</h3></a>
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
	<div class="modal fade" id="nuevocondominio" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar condominio</h4>
	                <form action="{{ url('/agregar-condominio') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        					<input class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" placeholder="Identificador" required>
										<input class="form-control" id="imagenNuevo" type="file" name="imagen" required>
	                  <textarea class="form-control" name="direccion" placeholder="Dirección" rows="10" required>Dirección</textarea>
	        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
	                </form>
	      				</div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal detalles user -->

	@if ($condominios)
		@foreach ($condominios as $condominio)
			<div class="modal fade" id="condominio{{$condominio->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Actualizar condominio</h4>
			                <form action="{{ url('/actualizar-condominio') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
			        					<input class="form-control" type="text" value="{{ $condominio->identificador }}" name="identificador" placeholder="Identificador" required>
												<input class="form-control" type="file" name="imagen">
			                  <textarea class="form-control" name="direccion" placeholder="Dirección" rows="10" required>{{ $condominio->direccion }}</textarea>
												<input type="hidden" name="condominio_id" value="{{ $condominio->id }}">
												<div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $condominio->id }}').click();">Borrar</a>
                        </div>
			                </form>
											<form style="display: none;" action="{{ url('/eliminar-condominio') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="condominio_id" value="{{ $condominio->id }}">
                        <input type="submit" id="botoneliminar{{ $condominio->id }}">
                      </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

@endsection
