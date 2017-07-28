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
											<a class="list-group-item" data-toggle="modal" data-target="#calendario{{$coach->id}}">Ver calendario</a>
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
@endsection
