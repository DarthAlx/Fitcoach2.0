@extends('plantilla')
@section('pagecontent')
<section class="container-bootstrap">
  <div class="topclear">
	    &nbsp;
	  </div>
  <div class="modal-body row">
    <div class="col-sm-12">
      @foreach ($items as $product)

										<h6><strong>{{ $product->price}} <span class="text-muted"></span></strong></h6>

							@endforeach
    </div>
  </div>
</section>
@endsection
