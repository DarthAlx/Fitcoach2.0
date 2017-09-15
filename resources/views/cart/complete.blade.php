@extends('plantilla')
@section('pagecontent')
<section class="container-bootstrap">
  <div class="topclear">
	    &nbsp;
	  </div>
  <div class="modal-body row">
      <div class="col-sm-12">
          <h1 class="gotham2 text-center" style="padding: 15vh 0;">!Orden completada! revisa <a class='alert-link' href='{{url('/perfil')}}'>tus ordenes.</a> <br><br><br> <a class="btn btn-success" style="width: 65%; margin: 0 auto;" href="{{url('/clasesdeportivas')}}">Seguir comprando</a></h1>
      </div>
  </div>
</section>
@endsection
