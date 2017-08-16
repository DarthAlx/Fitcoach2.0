@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-9">
					<div class="title">DEPORTIVAS</div>
				</div>
				<div class="col-sm-3">
					<div class="buscador">
						<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar...">
						<span class="input-group-btn">
							<button class="form-control" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
		</div>
    <div class="teamItemWrap clear">
			@if ($clases)
				@foreach ($clases as $clase)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#clase{{$clase->id}}"><img src="{{ url('uploads/clases') }}/{{ $clase->imagen }}" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#calendario{{$clase->id}}"><h3>{{ucfirst($clase->nombre)}}</h3></a>
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
	  @if ($clases)
			@foreach ($clases as $clase)
				<div class="modal fade" id="calendario{{$clase->id}}" tabindex="-1" role="dialog">
					<div class="modal-dialog calendario" role="document">
						<div class="modal-content">
							<div class="modal-body">

								<?php
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

							<h1 class="title">{{ucfirst($clase->nombre)}} </h1>



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
	                                  <?php $nombre=explode(" ",$particular->user->name); ?>
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


				        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><em class="fa fa-2x fa-chevron-left" aria-hidden="true" style="color: #000;"></em>
				        </a>
				        <a class="right carousel-control" href="#myCarousel" data-slide="next"><em class="fa fa-2x fa-chevron-right" aria-hidden="true" style="color: #000;"></em>
				        </a>
								<div id="clasesseleccionadas" class="title text-center">

								</div>
								<input type="hidden" name="cantidad" id="cantidad">
								<input type="submit" class="btn btn-success btn-lg" name="" value="Reservar">
								</form>
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
