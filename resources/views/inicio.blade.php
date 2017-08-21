@extends('plantilla')
@section('pagecontent')
	<section class="container" style="padding-bottom:0px;">
		<!-- The overlay -->




		<div class="homeBxSliderWrap">
			<div class="homeBxSlider">
				@foreach ($sliders as $slider)
					<div class="slide" data-slide="{{ $slider->id-1	}}" style="background-image: url({{ url('images/content/')}}/{{ $slider->image	}});">

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
			<div class="container-bootstrap text-center">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-2 text-center">
						<a href="{{ url('/clasesdeportivas') }}" class="btn-success btn">
							<i class="fa fa-home fa-6" aria-hidden="true"></i>
							<h3>CLASE <br> PARTICULAR</h3>
						</a>
					</div>
					<div class="col-sm-4 text-center">
						<a href="{{url('condominios')}}" class="btn-success btn">
							<i class="fa fa-building fa-6" aria-hidden="true"></i>
							<h3>CONDOMINIOS <br> AFILIADOS</h3>
						</a>
					</div>
				</div>



	    </div>

		</section>
@endsection
