@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="container-bootstrap">
			<div class="row">
				@include('holders.notificaciones')
				<div class="paddingtop">
                            <h1 class="title">CONTACTO</h1>
                            <hr>
														<div class=" col-md-12 coupon">
															<label>¡Queremos saber de ti! Déjanos tus datos y un Asesor Wellness se pondrá en contacto contigo.</label>
                                                        </div>
                                                        <div class="col-md-3 coupon"><label>Tel: 5523907490</label></div>
                        <div class="col-md-9 coupon"><label>Av de las Plazas, Bosque Real, Huxquilucan, Estado de Mexico</label></div>
													</div>
												<form method="post" enctype="multipart/form-data" action="{{ url('/contacto') }}">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="nombre" class="form-control" placeholder="Nombre" type="text"> </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="email" class="form-control" placeholder="Email" type="text"> </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="tel" class="form-control" placeholder="Teléfono" type="text"> </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input name="asunto" class="form-control" placeholder="Asunto" type="text"> </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" name="msg" rows="6" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" value="SEND" id="catwebformbutton" class="btn btn-lg btn-success" onclick="fbq('track', 'Lead');">ENVIAR</button>
                            </div>

                        </form>

                        
			</div>
		</div>
		<p>&nbsp;</p>


	</section>
@endsection
