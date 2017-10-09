@extends('plantilla')

@section('pagecontent')

  <section class="container-bootstrap">
    <div class="row">
      <div class="topclear">
        &nbsp;
      </div>
      <div class="checkoutPage clear">
        <div class="clear"></div>

        @include('holders.notificaciones')
        <div class="col-sm-6">
  				<h3>Recuperación de contraseña</h3>
          <form class="row" action="{{ url('/password/reset') }}" method="post">
            <p class="col-sm-6">
              <input type="hidden" name="token" value="{{ $token }}">
              <input type="hidden" name="email" value="{{ $email }}">
    					<label>Nueva contraseña</label><br>
    					<input class="form-control" type="password" name="password">
    				</p>
            <p class="col-sm-6">

    					<label>Confirma tu contraseña</label><br>
    					<input class="form-control" type="password" name="password_confirmation">
              {!! csrf_field() !!}
    				</p>
            <div class="col-sm-12">
              <input class="btn btn-primary" type="submit" value="Reestablecer contraseña">

            </div>


          </form>
  				<div class="clear"></div>
  			   </div>
          <div class="clear"></div>
		     </div>
       </div>
     </section>
        @endsection
