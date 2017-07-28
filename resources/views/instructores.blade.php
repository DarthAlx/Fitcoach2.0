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
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#coach{{$coach->id}}"><h3>{{ucfirst($coach->name)}}</h3></a>
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
							$fecha = date('Y-m-j');
							$fechas=array();
							setlocale(LC_TIME, "es-ES");

							for ($i=0; $i < 30 ; $i++) {
								$nuevafecha = strtotime ( '+'.$i.'day' , strtotime ( $fecha ) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
								$fechas[]= $nuevafecha;
							}

							 ?>
			<div class="container-fluid" id="trabajo">
        <div class="row">
      		<div class="col-md-12">
						<h1 class="title">{{ucfirst($coach->name)}}</h1>
						<div id="myCarousel" class="carousel slide">
		        <ol class="carousel-indicators">
		            <li data-target="#myCarousel" data-slide-to="0" class="active"> </li>
		            <li data-target="#myCarousel" data-slide-to="1"> </li>

		        </ol>

		        <div class="carousel-inner">
		        <div class="item active">
			        <div class="row-fluid">
				        <div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[0])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[1])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[2])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[3])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[4])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[5])))}}</div>

			        </div>
		        </div>
						<div class="item">
			        <div class="row-fluid">
				        <div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[6])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[7])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[8])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[9])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[10])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[11])))}}</div>

			        </div>
		        </div>
						<div class="item">
			        <div class="row-fluid">
				        <div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[12])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[13])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[14])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[15])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[16])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[17])))}}</div>

			        </div>
		        </div>
						<div class="item">
			        <div class="row-fluid">
				        <div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[18])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[19])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[20])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[21])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[22])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[23])))}}</div>

			        </div>
		        </div>
						<div class="item">
			        <div class="row-fluid">
				        <div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[24])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[25])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[26])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[27])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[28])))}}</div>
								<div class="col-sm-2 col-xs-4">{{ucfirst(strftime("%A %d", strtotime($fechas[29])))}}</div>

			        </div>
		        </div>








		        </div>

		        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><em class="fa fa-2x fa-chevron-left" aria-hidden="true" style="color: #000;"></em>
		        </a>
		        <a class="right carousel-control" href="#myCarousel" data-slide="next"><em class="fa fa-2x fa-chevron-right" aria-hidden="true" style="color: #000;"></em>
		        </a>
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
