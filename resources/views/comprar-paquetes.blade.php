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
				<div class="col-md-2">
					<div class="paquete">
						<div class="blue-cap"></div>
						<div class="info-paquete">
							<div class="circulo gotham2">
								1
							</div>
							<div class="color_gris2 gotham3 uppercase super_small">
								CLASE
							</div>
							<div class="precios gotham3 medium">
									$300 MXN
							</div>
							<div class="color_gris3 gotham3 v_small">
								Expira: 30 días
							</div>
							
						</div>
							<form action="{{url('/comprar-paquete')}}/1">
								<input type="hidden" name="paquete" value="1">
							</form>
					</div>
				</div>
				
			</div>
		</div>
	</section>
@endsection


@section('modals')
 

@endsection
