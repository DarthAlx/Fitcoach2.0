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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">EVENTOS</div>
					<div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('eventos')}}" method="post">
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
			  			<form action="{{url('eventos')}}" method="post">
								{!! csrf_field() !!}
			  				<input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
								<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  			</form>
			  		</div>

					</div>
				</div>

			</div>
			@include('holders.notificaciones')
		</div>
		<p>&nbsp;</p>
    <div class="teamItemWrap clear">
			@if ($eventos)
				@foreach ($eventos as $evento)
	        <div class="teamItem">
	          <a><img src="{{ url('uploads/clases') }}/{{ $evento->imagenevento }}" class="img-responsive"></a>
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

  @if ($eventos)
    @foreach ($eventos as $evento)

    		<div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
    		  <div class="modal-dialog" role="document">
    		    <div class="modal-content">
    		      <div class="modal-body  evento">
    		              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
    									<div class="container-bootstrap" style="width: 100%;">
    										<div class="row">
    											<div class="col-sm-8 sidebar">
    												<div class="text-center">
															<img src="{{ url('uploads/clases') }}/{{ $evento->imagenevento }}" alt="{{$evento->nombreevento}}" style="max-width:200px;float-left;">
    																<div class="title">
    																		{{$evento->nombreevento}}

    																</div>
    															 <div class="profile-userpic">
    																 <img src="{{ url('uploads/avatars') }}/{{ $evento->user->detalles->photo }}" class="img-responsive" alt="">
    															 </div>
																	 <?php $nombre=explode(" ",$evento->user->name); ?>
																	 <h2>{{ucfirst($nombre[0])}}</h2>


    												</div>
    												<div class="gotham2 text-center">
															<p><span>Fecha:</span> {{$evento->fecha}}</p>
    													<p><span>Hora:</span> {{$evento->hora}}</p>

    													<p>
																 <span>Disponibilidad:</span> {{intval($evento->cupo)-intval($evento->ocupados)}} personas
															</p>

															<p><span>Ubicación:</span><br> {{$evento->direccionevento}}</p>

    												</div>

    											</div>
    											<div class="col-sm-4 sidebar">
    												<div class="title pull-right">
    													${{$evento->precio}}
    												</div>

    												<form action="{{url('carrito')}}" method="post">
    													{!! csrf_field() !!}
    													<input type="hidden" name="residencial_id" value="{{$evento->id}}">
															<input type="hidden" name="tipo" value="Evento">
															<div class="row">
																<div class="col-sm-8 col-sm-offset-4">
																		<input type="submit" class="btn btn-success btn-lg" name="" value="Reservar">
																</div>
															</div>
    												</form>

														<p><span>Descripción:</span> <br>{{$evento->descripcion}}</p>
    											</div>
    										</div>

    									</div>

    		      </div>
    		    </div><!-- /.modal-content -->
    		  </div><!-- /.modal-dialog -->
    		</div><!-- /.modal contraseña -->

    @endforeach

  @endif

@endsection
