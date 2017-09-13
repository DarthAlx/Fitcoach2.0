@extends('plantilla')
@section('pagecontent')
	<style type="text/css">
	.contact #header .headerWrap, .about #header .headerWrap, .home #header .headerWrap {
		background: transparent !important;
		border-bottom-color: #fff !important;
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
			<div class="container-bootstrap-fluid text-center" id="botones">
				<div class="row">
					<div class="col-sm-3 col-sm-offset-2 text-center">
						<a href="{{ url('/clasesdeportivas') }}">
							<img src="{{ url('images/home.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/home2.png')}}'" onmouseout="this.src='{{ url('images/home.png')}}'" alt="">
						</a>
					</div>
					<div class="col-sm-3 col-sm-offset-2 text-center">
						<a href="{{url('residenciales')}}">
							<img src="{{ url('images/building.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/building2.png')}}'" onmouseout="this.src='{{ url('images/building.png')}}'" alt="">

						</a>
					</div>
				</div>



	    </div>

		</section>
@endsection
