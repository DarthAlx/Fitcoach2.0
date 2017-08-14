@extends('plantilla')

@section('pagecontent')
<section class="container">
  <div class="page404Wrap">
    <img src="{{ url('/images') }}/404.png" alt="">
    <p>La página que buscaste no fué encontrada</p>
    <a href="{{ url('/') }}" class="homePage">Home</a>
  </div>
</section>
@endsection
