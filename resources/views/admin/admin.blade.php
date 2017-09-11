@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap">
  <div class="topclear">
    &nbsp;
  </div>
  <div class="row profile">
      <div class="col-sm-12">
        @include('holders.notificaciones')
        <?php $nombre=explode(" ",$user->name);
        if ( ! isset($nombre[1])) {
            $nombre[1] = null;
        }?>
        <h2>Hola <span class="nombre">{{ucfirst($nombre[0])}} {{ucfirst($nombre[1])}}</span></h2>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/admins') }}">
        <img src="{{ url('images/usuarios.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/usuarios_b.png')}}'" onmouseout="this.src='{{ url('images/usuarios.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/condominios') }}">
        <img src="{{ url('images/condominios.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/condominios_b.png')}}'" onmouseout="this.src='{{ url('images/condominios.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/grupos') }}">
        <img src="{{ url('images/grupos.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/grupos_b.png')}}'" onmouseout="this.src='{{ url('images/grupos.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/ventas') }}">
        <img src="{{ url('images/ventas.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/ventas_b.png')}}'" onmouseout="this.src='{{ url('images/ventas.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/clases') }}">
        <img src="{{ url('images/clases.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/clases_b.png')}}'" onmouseout="this.src='{{ url('images/clases.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/') }}">
        <img src="{{ url('images/clientes.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/clientes_b.png')}}'" onmouseout="this.src='{{ url('images/clientes.png')}}'" alt="">
      </a>
    </div>
    <div class="col-sm-4 col-xs-6">
      <a href="{{ url('/nomina') }}">
        <img src="{{ url('images/nomina.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/nomina_b.png')}}'" onmouseout="this.src='{{ url('images/nomina.png')}}'" alt="">
      </a>
    </div>

  </div>


</div>



@endsection

@section('modals')

@endsection
