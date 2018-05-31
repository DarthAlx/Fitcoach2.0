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
			<div class="row text-center">
				<div class="paquete-center">
				@foreach($particulares as $paquete)
					@if($paquete->paquete=="Primer clase")
						<div class="col-md-2">
							<div class="paquete" onclick="location.href='{{url('/comprar-paquete')}}/{{$paquete->id}}'" style="cursor:pointer;">
								<div class="blue-cap"></div>
								<div class="info-paquete">
									<div class="circulo gotham2">
										<i class="fa fa-gift" aria-hidden="true"></i>
									</div>
									<div class="color_gris2 gotham3 uppercase super_small">
										 PRIMER CLASE
									</div>
									<div class="precios gotham3 medium">
											${{$paquete->precio}}
									</div>
									<div class="color_gris3 gotham3 v_small ppc">
										&nbsp;
									</div>
									<div class="color_gris3 gotham3 v_small">
										&nbsp;<br>
										&nbsp;
									</div>
									
								</div>
							</div>
						</div>
					@else
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
											${{$paquete->precio}}
									</div>
									<div class="color_gris3 gotham3 v_small ppc">
										PRECIO POR CLASE: ${{$paquete->precio_clase}}
									</div>
									<div class="color_gris3 gotham3 v_small">
										&nbsp;<br>
										Expira: {{$paquete->dias}} días
									</div>
									
								</div>
							</div>
						</div>
					@endif
				@endforeach
				</div>
			</div>

			<div class="row text-center">
				<div class="paquete-center">
				@foreach($residenciales as $paquete)
					@if($paquete->paquete=="Primer clase")
						<div class="col-md-2">
							<div class="paquete" onclick="location.href='{{url('/comprar-paquete')}}/{{$paquete->id}}'" style="cursor:pointer;">
								<div class="blue-cap"></div>
								<div class="info-paquete">
									<div class="circulo gotham2">
										<i class="fa fa-gift" aria-hidden="true"></i>
									</div>
									<div class="color_gris2 gotham3 uppercase super_small">
										 PRIMER CLASE
									</div>
									<div class="precios gotham3 medium">
											${{$paquete->precio}}
									</div>
									<div class="color_gris3 gotham3 v_small ppc">
										&nbsp;
									</div>
									<div class="color_gris3 gotham3 v_small">
										&nbsp;<br>
										&nbsp;
									</div>
									
								</div>
							</div>
						</div>
					@else
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
											${{$paquete->precio}}
									</div>
									<div class="color_gris3 gotham3 v_small ppc">
										PRECIO POR CLASE: ${{$paquete->precio_clase}}
									</div>
									<div class="color_gris3 gotham3 v_small">
										&nbsp;<br>
										Expira: {{$paquete->dias}} días
									</div>
									
								</div>
							</div>
						</div>
					@endif
				@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection


@section('modals')
 

@endsection
