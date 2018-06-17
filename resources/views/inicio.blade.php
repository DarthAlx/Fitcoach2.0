@extends('plantilla')
@section('pagecontent')
	<style type="text/css">
	.contact #header .headerWrap, .about #header .headerWrap, .home #header .headerWrap {
		background: transparent !important;
		/*border-bottom-color: #fff !important;*/
	}
	.catalog .mainMenu > ul > li a, .contact .mainMenu > ul > li a, .about .mainMenu > ul > li a,  .home .mainMenu > ul > li a {
		color: #fff !important; opacity: 1 !important; -webkit-transition: opacity 0.3s ease;-moz-transition: opacity 0.3s ease;-o-transition: opacity 0.3s ease;transition: opacity 0.3s ease;
	}
	#header .headerWrap.is-sticky {
    background: #fff!important;
    border-bottom-color: rgba(0,0,0,0)!important;
    z-index: 99999;
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.06)!important;
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.06)!important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06)!important;
}
#header .is-sticky .mainMenu ul li a {
    color: #7f7f7f !important;
}

	</style>
	<section class="container" style="padding-bottom:0px;">
		<!-- The overlay -->




		<div class="homeBxSliderWrap">
			<div class="homeBxSlider">
				@foreach ($sliders as $slider)
					<div class="slide" data-slide="{{ $slider->id-1	}}" style="background-image: url({{ url('images/content/')}}/{{ $slider->image	}});">
							<p class="visible-xs">&nbsp;</p>
							<div class="slideDesc">
						 		{!! $slider->description !!}
					 		</div>
					</div>
				@endforeach


				</div>

			</div>
			@include('holders.notificaciones')
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			

		</section>

		<section class="paquetes" id="paquetes">
		<div class="container-bootstrap">
			<div class="row">
				<div class="col-md-12  disponibles">
					
				
			<div class="row text-center">
				<div class="paquete-center">
				
					<div class="col-md-2 col-xs-6">
						<div class="paquete" onclick="location.href='{{url('/clasesdeportivas')}}'" style="cursor:pointer; color: #EF7E19; border: 0;">
							
							<div>
								<div class="circulo gotham2">
									<i class="fa fa-home" aria-hidden="true"></i>
								</div>
								<div class=" gotham3 uppercase super_small">
									 CLASES A DOMICILIO
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
				@foreach($particulares as $paquete)
					@if($paquete->paquete=="Primer clase")
						<div class="col-md-2 col-xs-6">
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
						<div class="col-md-2 col-xs-6">
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
	</div>
		<div class="row">
				<div class="col-md-12  disponibles">

			<div class="row text-center">
				<div class="paquete-center">
					<div class="col-md-2 col-xs-6">
						<div class="paquete" onclick="location.href='{{url('/condominios')}}'" style="cursor:pointer; color: #EF7E19; border: 0;">
							
							<div>
								<div class="circulo gotham2">
									<i class="fa fa-building" aria-hidden="true"></i>
								</div>
								<div class=" gotham3 uppercase super_small">
									 CONDOMINIOS
								</div>
								<div class="precios gotham3 medium">
										&nbsp;
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
				@foreach($residenciales as $paquete)
					@if($paquete->paquete=="Primer clase")
						<div class="col-md-2 col-xs-6">
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
						<div class="col-md-2 col-xs-6">
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
		</div>
		</div>
	</section>
@endsection
