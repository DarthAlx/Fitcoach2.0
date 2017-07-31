@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="">
    <div class="title">COACHES</div>
    <div class="teamItemWrap clear">
			@if ($coaches)
				@foreach ($coaches as $coach)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#coach{{$coach->id}}"><img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" alt=""></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
								<?php $nombre=explode(" ",$coach->name); ?>
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#coach{{$coach->id}}"><h3>{{ucfirst($nombre[0])}}</h3></a>
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
													 <h2>{{$coach->name}}</h2>

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
				                $fecha=date_create($residencial->fecha);
				                setlocale(LC_TIME, "es-ES");
													?>
												<a href="#" class="list-group-item" data-toggle="modal" data-target="#condominio{{$residencial->id}}">
													<i class="fa fa-building" aria-hidden="true"></i>
				 									{{strftime("%d %B", strtotime($residencial->fecha))}} | {{ $residencial->hora }} | {{$residencial->condominio->identificador}}
				 									<i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
												</a>
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
			<div class="modal fade" id="calendario{{$coach->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">

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
							<div id="myCarousel" class="carousel slide">
			        <div class="carousel-inner">
								@for ($i=0; $i < 5 ; $i++)
									@if ($i==0)
										<div class="item active">
									@else
										<div class="item">
									@endif
						        <div class="row-fluid">
											@for ($x=$i*6; $x < ($i+1)*6 ; $x++)
												<div class="col-sm-2 col-xs-4 separacion">
													{{$fechasformateadas[$x]}}
													<ul class="list-group calendarioinst">
														<?php $particulares=App\Particular::all();
														list($año, $mes, $dia) = explode("-", $fechas[$x]);
														$dia_n=date("w", mktime(0, 0, 0, $mes, $dia, $año));
														?>
														@foreach ($particulares as $particular)
															<?php $existe=App\Orden::where('coach_id', $particular->user_id)->where('fecha', $fechas[$x])->where('hora', $particular->hora)->first(); ?>
															@if (!$existe)
																@if ($particular->fecha==$fechas[$x]||in_array($dia_n, explode(",",$particular->recurrencia)))
																	<li class="list-group-item" onclick="agregaracarrito('{{$x}}{{$particular->id}}');" style="cursor:pointer;">
																		<input type="checkbox" id="carrito{{$x}}{{$particular->id}}" name="carrito[]" value="{{$particular->id}},{{$fechas[$x]}}" style="display:none">
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


			        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><em class="fa fa-2x fa-chevron-left" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        <a class="right carousel-control" href="#myCarousel" data-slide="next"><em class="fa fa-2x fa-chevron-right" aria-hidden="true" style="color: #000;"></em>
			        </a>
			        </div>

							<input type="submit" class="btn btn-primary btn-lg pull-right" name="" value="Reservar">
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
		function agregaracarrito(valor){
			if (document.getElementById('carrito'+valor).checked) {
				document.getElementById('carrito'+valor).checked = false;
				$('#carrito'+valor).removeClass('seleccionada');
				$('.fa'+valor).removeClass('fa-square');
				$('.fa'+valor).addClass('fa-square-o');
			}
			else {
				document.getElementById('carrito'+valor).checked = true;
				$('#carrito'+valor).addClass('seleccionada');
				$('.fa'+valor).removeClass('fa-square-o');
				$('.fa'+valor).addClass('fa-square');
			}
		}
	</script>
@endsection
