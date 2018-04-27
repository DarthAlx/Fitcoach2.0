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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">COMPRAR CLASES</div>
				</div>
			</div>
			@include('holders.notificaciones')
		</div>
		<p>&nbsp;</p>
    
  </div>
	</section>
	<section class="paquetes">
		<div class="container-bootstrap">
			<div class="row">
				@foreach($paquetes as $paquete)
				<div class="col-md-2">
					<div class="paquete" onclick="location.href='{{url('/comprar-paquete')}}/{{$paquete->id}}'" style="cursor:pointer;">
						<div class="blue-cap"></div>
						<div class="info-paquete">
							<div class="circulo gotham2">
								{{$paquete->num_clases}}
							</div>
							<div class="color_gris2 gotham3 uppercase super_small">
								CLASE
							</div>
							<div class="precios gotham3 medium">
									${{$paquete->precio}} MXN
							</div>
							<div class="color_gris3 gotham3 v_small">
								Expira: {{$paquete->dias}} días
							</div>
							
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
@endsection


@section('modals')
 

@endsection
