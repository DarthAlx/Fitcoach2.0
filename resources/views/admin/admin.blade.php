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
    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="admins" style="display:none;">
      <a href="{{ url('/admins') }}">
        <img src="{{ url('images/usuarios.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/usuarios_b.png')}}'" onmouseout="this.src='{{ url('images/usuarios.png')}}'" alt="">
      </a>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="coaches-admin" style="display:none;">
      <a href="{{ url('/coaches-admin') }}">
        <img src="{{ url('images/coaches.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/coaches_b.png')}}'" onmouseout="this.src='{{ url('images/coaches.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="condominios" style="display:none;">
      <a href="{{ url('/residenciales') }}">
        <img src="{{ url('images/condominios.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/condominios_b.png')}}'" onmouseout="this.src='{{ url('images/condominios.png')}}'" alt="">
      </a>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="rooms" style="display:none;">
      <a href="{{ url('/rooms') }}">
        <img src="{{ url('images/grupos.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/grupos_b.png')}}'" onmouseout="this.src='{{ url('images/grupos.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="grupos" style="display:none;">
      <a href="{{ url('/grupos') }}">
        <img src="{{ url('images/grupos.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/grupos_b.png')}}'" onmouseout="this.src='{{ url('images/grupos.png')}}'" alt="">
      </a>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="eventos-admin" style="display:none;">
      <a href="{{ url('/eventos-admin') }}">
        <img src="{{ url('images/eventos.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/eventos_b.png')}}'" onmouseout="this.src='{{ url('images/eventos.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="clases" style="display:none;">
      <a href="{{ url('/clases') }}">
        <img src="{{ url('images/clases.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/clases_b.png')}}'" onmouseout="this.src='{{ url('images/clases.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="clasesvista" style="display:none;">
      <a href="{{ url('/clasesvista') }}">
        <img src="{{ url('images/rclases.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/rclases_b.png')}}'" onmouseout="this.src='{{ url('images/rclases.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="ventas" style="display:none;">
      <a href="{{ url('/ventas') }}">
        <img src="{{ url('images/ventas.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/ventas_b.png')}}'" onmouseout="this.src='{{ url('images/ventas.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="nomina" style="display:none;">
      <a href="{{ url('/nomina') }}">
        <img src="{{ url('images/nomina.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/nomina_b.png')}}'" onmouseout="this.src='{{ url('images/nomina.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="clientes" style="display:none;">
      <a href="{{ url('/clientes') }}">
        <img src="{{ url('images/clientes.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/clientes_b.png')}}'" onmouseout="this.src='{{ url('images/clientes.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="cupones" style="display:none;">
      <a href="{{ url('/cupones') }}">
        <img src="{{ url('images/cupones.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/cupones_b.png')}}'" onmouseout="this.src='{{ url('images/cupones.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="slides" style="display:none;">
      <a href="{{ url('/slides') }}">
        <img src="{{ url('images/slider.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/slider_b.png')}}'" onmouseout="this.src='{{ url('images/slider.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="zonas" style="display:none;">
      <a href="{{ url('/zonas') }}">
        <img src="{{ url('images/zonas.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/zonas_b.png')}}'" onmouseout="this.src='{{ url('images/zonas.png')}}'" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 modulo" id="reportes" style="display:none;">
      <a href="{{ url('/reportes') }}">
        <img src="{{ url('images/zonas.png')}}" class="img-responsive" onmouseover="this.src='{{ url('images/zonas_b.png')}}'" onmouseout="this.src='{{ url('images/zonas.png')}}'" alt="">
      </a>
    </div>

  </div>


</div>

<script type="text/javascript">
  <?php $permisos=explode(",",$user->detalles->permisos); ?>
  @if ($user->role=="superadmin")
    $(".modulo").show();
  @endif
  @foreach ($permisos as $permiso)
    document.getElementById("{{$permiso}}").style.display="block";
  @endforeach

</script>



@endsection

@section('modals')

@endsection
