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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">COACHES</div>
					<div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('buscarcoach')}}" method="post">
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
			  			<form action="{{url('buscarcoach')}}" method="post">
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
			@if ($coaches)
				@foreach ($coaches as $coach)
	        <div class="teamItem">
	          <a><img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" alt=""></a>
	          <div class="overlay" data-toggle="modal" data-target="#coach{{$coach->id}}">
	            <div class="teamItemNameWrap">
								<?php $nombre=explode(" ",$coach->name); ?>
	              <a style="text-decoration:none;"><h3>{{ucfirst($nombre[0])}}</h3></a>
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
	@if ($coaches)
		@foreach ($coaches as $coach)
			<div class="modal fade" id="coach{{$coach->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
							<div class="container-bootstrap" style="width: 100%;">
								<div class="row">
									<div class="col-sm-4 col-sm-offset-4 sidebar">
										<div class="text-center">

													 <div class="profile-userpic">
														 <img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" class="img-responsive" alt="">
													 </div>
													 <?php $nombre=explode(" ",$coach->name); ?>
													 <h2>{{ucfirst($nombre[0])}}</h2>

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<h1 class="gotham2">Particulares</h1>
										@if ($coach->particulares)
											<a href="#" class="list-group-item" data-toggle="modal" data-target="#calendario{{$coach->id}}">Ver calendario</a>
										@else
											Este coach no tiene horarios disponibles.
										@endif
									</div>
									<div class="col-sm-6">
										<h1 class="gotham2">Residenciales</h1>
										@if ($coach->residenciales)
											@foreach ($coach->residenciales as $residencial)
												<?php
												date_default_timezone_set('America/Mexico_City');
				                $fecha=new DateTime($residencial->fecha);
												$hoy=new DateTime("now");
				                setlocale(LC_TIME, "es-ES");
												$interval = date_diff($hoy, $fecha);
												$intervalo = intval($interval->format('%R%a días'));
													?>

													@if ($residencial->ocupados<$residencial->cupo&&$intervalo>=0&&$residencial->tipo=="Residencial")
														<a href="#" class="list-group-item" data-toggle="modal" data-target="#condominio{{$residencial->id}}">
															<i class="fa fa-building" aria-hidden="true"></i>
						 									{{strftime("%d %b", strtotime($residencial->fecha))}} | {{ $residencial->hora }} | {{$residencial->condominio->identificador}}
						 									<i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
														</a>
													@endif

											@endforeach
										@else
											Este coach no tiene horarios disponibles.
										@endif
									</div>
								</div>
							</div>
						</div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

@if ($coaches)
	@foreach ($coaches as $coach)
		@if ($coach->residenciales)

			@foreach ($coach->residenciales as $residencial)
				@if ($residencial->tipo=="Residencial")
				<div class="modal fade" id="condominio{{$residencial->id}}" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-body residencial">
				              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
											<div class="container-bootstrap" style="width: 100%;">
												<div class="row">
													<div class="col-sm-4 sidebar">
														<div class="text-center">
																		<div class="title">
																				{{$residencial->clase->nombre}}

																		</div>
																	 <div class="profile-userpic">
																		 <img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" class="img-responsive" alt="">
																	 </div>
																	 <?php $nombre=explode(" ",$coach->name); ?>
																	 <h2>{{ucfirst($nombre[0])}}</h2>
														</div>
														<div class="gotham2 text-center">
															<p><strong>Hora:</strong> {{$residencial->hora}}</p>
															<p><strong>Lugar:</strong> {{$residencial->condominio->identificador}}<br>{{$residencial->condominio->direccion}}</p>
															<p><strong>Cupo:</strong> {{$residencial->cupo}} personas <br>
																 <strong>Lugares disponibles:</strong> {{intval($residencial->cupo)-intval($residencial->ocupados)}}
															</p>
														</div>

													</div>
													<div class="col-sm-8 sidebar">
														<div class="title text-center">
															${{$residencial->precio}}

														</div>
														<!--img src="{{ url('uploads/condominios') }}/{{ $residencial->condominio->imagen }}" class="img-responsive"-->
														<form action="{{url('carrito')}}" method="post">
															{!! csrf_field() !!}
															<input type="hidden" name="residencial_id" value="{{$residencial->id}}">
															<input type="hidden" name="tipo" value="Residencial">
															<div class="row">
																<div class="col-sm-8 col-sm-offset-4">
																		<input type="submit" class="btn btn-success btn-lg" name="" value="Reservar">
																</div>
															</div>

														</form>
													</div>
												</div>

											</div>

				      </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal contraseña -->
				@endif
			@endforeach
		@endif
	@endforeach

@endif





	@if ($coaches)
		@foreach ($coaches as $coach)
			<div class="modal fade" id="calendario{{$coach->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog calendario" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

							<?php
							$clase=App\Clase::find($coach->detalles->clases);

							$fecha = date('Y-m-d');
							$fechas=array();
							$fechasformateadas=array();
							setlocale(LC_TIME, "es-MX");
							date_default_timezone_set('America/Mexico_City');

							for ($i=0; $i < 30 ; $i++) {
								$nuevafecha = strtotime ( '+'.$i.'day' , strtotime ( $fecha ) ) ;
								$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
								$format=date("d", strtotime($nuevafecha));
								$numdias=date("w", strtotime($nuevafecha));
								$nummeses=date("n", strtotime($nuevafecha));
								$arraydia=array('Dom','Lun','Mar','Mié','Jue','Vie','Sáb');
								$arraymes=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto', 'Septiembre','Octubre','Noviembre','Diciembre');
								$num=$arraydia[intval($numdias)];
								$nummes=$arraymes[intval($nummeses)-1];
								$fechas[]= $nuevafecha;
								$fechasformateadas[]=ucfirst($num . " " . $format . " " .$nummes);
							}

							 ?>
			<div class="container-fluid" id="trabajo">

        <div class="row">
      		<div class="col-md-12">
						<form action="{{url('carrito')}}" method="post">
							{!! csrf_field() !!}
							<?php $nombre=explode(" ",$coach->name); ?>
						<h1 class="title">{{ucfirst($nombre[0])}} : {{ucfirst($clase->nombre)}}</h1>

							<div id="myCarousel{{$coach->id}}" class="carousel slide hidden-xs" data-wrap="false"><!--6 columnas-->
								<div class="carousel-inner">
									@for ($i=0; $i < 5 ; $i++)
										@if ($i==0)
											<div class="item active">
										@else
											<div class="item">
										@endif
										<div class="row-fluid">
											@for ($x=$i*6; $x < ($i+1)*6 ; $x++)
												<div class="col-sm-2 col-xs-6 separacion">
													{{$fechasformateadas[$x]}}
													<ul class="list-group calendarioinst">
														<?php $particulares=App\Particular::where('user_id', $coach->id)->get();
														list($año, $mes, $dia) = explode("-", $fechas[$x]);
														$dia_n=date("w", mktime(0, 0, 0, $mes, $dia, $año));
														?>
														@foreach ($particulares as $particular)
															<?php $existe=App\Orden::where('coach_id', $particular->user_id)->where('fecha', $fechas[$x])->where('hora', $particular->hora)->first(); ?>
															@if (!$existe)
																@if ($particular->fecha==$fechas[$x]||in_array($dia_n, explode(",",$particular->recurrencia)))
																	<li class="list-group-item" onclick="agregaracarrito('{{$x}}{{$particular->id}}');" style="cursor:pointer;">
																		<input type="checkbox" id="carrito{{$x}}{{$particular->id}}" name="carrito[]" value="{{$particular->id}},{{$fechas[$x]}}" style="display:none">
																		<input type="hidden" name="tipo" value="Particular">
																		{{$particular->zona->identificador}}

																	<br>
																		{{$particular->hora}} <i class="fa fa-square-o pull-right fa{{$x}}{{$particular->id}}" aria-hidden="true"></i>
																	</li>
																@endif
															@endif
														@endforeach
													</ul>
												</div>
											@endfor
										</div>
						        </div>
									@endfor
				        </div>
			        <a class="left carousel-control" href="#myCarousel{{$coach->id}}" data-slide="prev"><em class="fa fa-2x fa-chevron-left" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        <a class="right carousel-control" href="#myCarousel{{$coach->id}}" data-slide="next"><em class="fa fa-2x fa-chevron-right" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        </div><!--6columnas fin-->

							<div id="myCarouselmini{{$coach->id}}" class="carousel slide visible-xs" data-wrap="false"><!--2 columnas-->
<div class="carousel-inner ">
								@for ($i=0; $i < 15 ; $i++)
									@if ($i==0)
										<div class="item active">
									@else
										<div class="item">
									@endif
									<div class="row-fluid">
										@for ($x=$i*2; $x < ($i+1)*2 ; $x++)
											<div class="col-xs-6 separacion">
												{{$fechasformateadas[$x]}}
												<ul class="list-group calendarioinst">
													<?php $particulares=App\Particular::where('user_id', $coach->id)->get();
													list($año, $mes, $dia) = explode("-", $fechas[$x]);
													$dia_n=date("w", mktime(0, 0, 0, $mes, $dia, $año));
													?>
													@foreach ($particulares as $particular)
														<?php $existe=App\Orden::where('coach_id', $particular->user_id)->where('fecha', $fechas[$x])->where('hora', $particular->hora)->first(); ?>
														@if (!$existe)
															@if ($particular->fecha==$fechas[$x]||in_array($dia_n, explode(",",$particular->recurrencia)))
																<li class="list-group-item" onclick="agregaracarrito('{{$x}}{{$particular->id}}');" style="cursor:pointer;">
																	<input type="checkbox" id="carrito{{$x}}{{$particular->id}}" name="carrito[]" value="{{$particular->id}},{{$fechas[$x]}}" style="display:none">
																	<input type="hidden" name="tipo" value="Particular">
																	{{$particular->hora}} <i class="fa fa-square-o pull-right fa{{$x}}{{$particular->id}}" aria-hidden="true"></i>
																</li>
															@endif
														@endif
													@endforeach
												</ul>
											</div>
										@endfor
									</div>
					        </div>
								@endfor
			        </div>


			        <a class="left carousel-control" href="#myCarouselmini{{$coach->id}}" data-slide="prev"><em class="fa fa-2x fa-chevron-left" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        <a class="right carousel-control" href="#myCarouselmini{{$coach->id}}" data-slide="next"><em class="fa fa-2x fa-chevron-right" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        </div><!--2 columnas fin-->


							<input type="hidden" name="cantidad" id="cantidad">
							<p>&nbsp;</p>
							<div class="row">
								<div class="col-sm-8">
									<div id="clasesseleccionadas" class="title text-center">
		 								0 clases seleccionadas.
									</div>
								</div>
								<p>&nbsp;</p>
								<div class="col-sm-4">
									<input type="submit" class="btn btn-success btn-lg" name="" value="Reservar" id="reservar" disabled>
								</div>
							</div>



							</form>
        	</div>

        </div>
      </div>

						</div>

					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

	<script type="text/javascript">
	clasesseleccionadas=0;
		function agregaracarrito(valor){
			if (document.getElementById('carrito'+valor).checked) {
				document.getElementById('carrito'+valor).checked = false;
				$('#carrito'+valor).removeClass('seleccionada');
				$('.fa'+valor).removeClass('fa-square');
				$('.fa'+valor).addClass('fa-square-o');
				if (clasesseleccionadas>0) {
					clasesseleccionadas--;
				}

				$('#cantidad').val(clasesseleccionadas);
				$('#clasesseleccionadas').html(clasesseleccionadas+" clases seleccionadas.");
				if (clasesseleccionadas<=0) {
					$('#reservar').prop( "disabled", true );
				}
			}
			else {
				document.getElementById('carrito'+valor).checked = true;
				$('#carrito'+valor).addClass('seleccionada');
				$('.fa'+valor).removeClass('fa-square-o');
				$('.fa'+valor).addClass('fa-square');
				clasesseleccionadas++;
				$('#cantidad').val(clasesseleccionadas);
				$('#clasesseleccionadas').html(clasesseleccionadas+" clases seleccionadas.");
				$('#reservar').prop( "disabled", false );
			}
		}
	</script>
@endsection
