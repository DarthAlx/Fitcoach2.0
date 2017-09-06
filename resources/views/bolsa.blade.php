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
                            <h1 class="title">BOLSA DE TRABAJO</h1>
                            <hr> </div>
												<form method="post" enctype="multipart/form-data" action="{{ url('/bolsa-de-trabajo') }}">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="nombre" class="form-control" placeholder="Nombre" type="text"> </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="email" class="form-control" placeholder="Email" type="text"> </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input name="tel" class="form-control" placeholder="Teléfono" type="text"> </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<label for="">Curriculum vitae</label>
                                <input name="cv" class="form-control" placeholder="Curriculum vitae" type="file"> </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" name="msg" rows="6" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" value="SEND" id="catwebformbutton" class="btn btn-lg btn-success">ENVIAR</button>
                            </div>

                        </form>
			</div>
		</div>
		<p>&nbsp;</p>


	</section>
@endsection
