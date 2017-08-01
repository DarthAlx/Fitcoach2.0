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
					<div class="title">DEPORTIVAS</div>
				</div>
				<div class="col-sm-3">
					<div class="buscador">
						<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar...">
						<span class="input-group-btn">
							<button class="form-control" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
		</div>
    <div class="teamItemWrap clear">
			@if ($clases)
				@foreach ($clases as $clase)
	        <div class="teamItem">
	          <a data-toggle="modal" data-target="#clase{{$clase->id}}"><img src="{{ url('uploads/clases') }}/{{ $clase->imagen }}" class="img-responsive"></a>
	          <div class="overlay">
	            <div class="teamItemNameWrap">
	              <a style="text-decoration:none;" data-toggle="modal" data-target="#calendario{{$clase->id}}"><h3>{{ucfirst($clase->nombre)}}</h3></a>
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
