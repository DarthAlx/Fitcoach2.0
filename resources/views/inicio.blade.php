@extends('plantilla')
@section('pagecontent')
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
			<div class="container-bootstrap text-center" id="botones">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-2 text-center">
						<a href="{{ url('/clasesdeportivas') }}">
							<img src="{{ url('images/home.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/home2.png')}}'" onmouseout="this.src='{{ url('images/home.png')}}'" alt="">
						</a>
					</div>
					<div class="col-sm-4 text-center">
						<a href="{{url('residenciales')}}">
							<img src="{{ url('images/building.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/building2.png')}}'" onmouseout="this.src='{{ url('images/building.png')}}'" alt="">

						</a>
					</div>
				</div>



	    </div>

		</section>
@endsection
