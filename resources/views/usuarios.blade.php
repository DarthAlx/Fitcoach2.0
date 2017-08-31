@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-9">
					<div class="title" style="font-size: 10vw;">USUARIOS</div>
				</div>
				<div class="col-sm-3">
					<div class="buscador">
						<div class="footerSubscribe">
			  			<form>
			  				<input class="" type="text" name="" value="" placeholder="Buscar...">
								<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  			</form>
			  		</div>

					</div>
				</div>
			</div>
		</div>
		<p>&nbsp;</p>
    <div class="teamItemWrap clear">
			@if ($usuarios)
				@foreach ($usuarios as $usuario)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#usuario{{$usuario->id}}"><img src="{{ url('uploads/usuarios') }}/{{ $usuario->detalles->photo }}" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#usuario{{$usuario->id}}"><h3>{{ucfirst($usuario->name)}}</h3></a>
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

@endsection
