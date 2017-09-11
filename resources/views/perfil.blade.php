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
    <div class="col-md-4 sidebar">
      <hr>
      <div class="claseanterior text-center">
        <h4>CLASE ANTERIOR</h4>
        @if ($user->ordenes)
          <?php
          $ultima= App\Orden::where('user_id', $user->id)->where('status', 'Completa')->orderBy('fecha', 'desc')->first();
          if ($ultima) {
            $coachu= App\User::find($ultima->coach_id);
            $nombre=explode(" ",$coachu->name);
             ?>

             <h1>{{$ultima->nombre}}</h1>
             <h2>{{ucfirst($nombre[0])}}</h2>
             <button type="button" class="btn btn-success">Calificar</button>
          <?php } else{ ?>
            <p>No has tomado ninguna clase.</p>
            <?php } ?>
        @endif
      </div>

      <div class="clasesperfil visible-xs">
        <hr>
        <div class="text-center">
          <button type="button" id="btnproximas" class="btn btn-success" style="display:inline-block; width:40%;" onclick="verclases('proximas')">Próximas clases</button>
          <button type="button" id="btnpasadas" class="btn btn-clases" style="display:inline-block; width:40%;" onclick="verclases('pasadas')">Clases pasadas</button>
          <script type="text/javascript">
            function verclases(valor) {
              if (valor=="proximas") {
                $('#pasadas').hide();
                $('#btnpasadas').addClass('btn-clases');$('#btnpasadas').removeClass('btn-success');
                $('#proximas').show();
                $('#btnproximas').addClass('btn-success');$('#btnproximas').removeClass('btn-clases');
              }
              if (valor=="pasadas") {
                $('#proximas').hide();
                $('#btnproximas').addClass('btn-clases');$('#btnproximas').removeClass('btn-success');
                $('#pasadas').show();
                $('#btnpasadas').addClass('btn-success');$('#btnpasadas').removeClass('btn-clases');
              }
            }
          </script>
        </div>

        <p>&nbsp;</p>
        <div id="proximas" class="listadeclases">
          <div class="list-group">
            @if ($user->ordenes)
              <?php
              $proximas= App\Orden::where('user_id', $user->id)->where('status', 'Proxima')->orderBy('fecha', 'desc')->get();
              if (!$proximas->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($proximas as $proxima) {


                  $fecha=date_create($proxima->fecha);
                  setlocale(LC_TIME, "es-ES");
                 ?>
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                   @if($proxima->tipo=="particular")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                   {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
              <?php } } else{ ?>
                <p>No has tomado ninguna clase.</p>
                <?php  } ?>
            @endif

          </div>
        </div>
        <div id="pasadas" class="listadeclases" style="display:none;">
          <div class="list-group">
            @if ($user->ordenes)
              <?php
              $pasadas= App\Orden::where('user_id', $user->id)->where('status', 'Completa')->orWhere('status', 'Cancelada')->orderBy('fecha', 'desc')->get();
              if (!$pasadas->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($pasadas as $pasada) {


                  $fecha=date_create($pasada->fecha);
                  setlocale(LC_TIME, "es-ES");
                 ?>
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                   @if ($pasada->status=="Cancelada")
                     <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                   @else
                     @if($pasada->tipo=="particular")
                       <i class="fa fa-home" aria-hidden="true"></i>
                     @else
                       <i class="fa fa-building" aria-hidden="true"></i>
                     @endif
                    @endif
                   {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
              <?php } } else{ ?>
                <p>No has tomado ninguna clase.</p>
                <?php  } ?>
            @endif

          </div>
        </div>
        </div>
<hr>
      <h4>MIS DATOS</h4>
      <button type="button" class="btn" data-toggle="modal" data-target="#datosdeusuario"><span>Datos de usuario</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#direcciones"><span>Direcciones</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#cambiarcontraseña"><span>Contraseña</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <hr>
      <h4>FORMAS DE PAGO</h4>
      @if(!$user->tarjetas->isEmpty())
        @foreach ($user->tarjetas as $tarjeta)
          <button type="button" class="btn" data-toggle="modal" data-target="#tarjeta{{$tarjeta->id}}"><span>{{$tarjeta->identificador}}</span>  <i class="fa fa-pencil" aria-hidden="true"></i></button>
        @endforeach
      @endif
      <button type="button" class="btn" data-toggle="modal" data-target="#agregartarjeta"><span>Nueva tarjeta +</span></button>
    </div>
    <div class="col-md-8">
    <div class="clasesperfil hidden-xs">
      <hr>
      <div class="text-center">
        <button type="button" id="btnproximaslg" class="btn btn-success" style="display:inline-block; width:40%;" onclick="verclaseslg('proximaslg')">Próximas clases</button>
        <button type="button" id="btnpasadaslg" class="btn btn-clases" style="display:inline-block; width:40%;" onclick="verclaseslg('pasadaslg')">Clases pasadas</button>
        <script type="text/javascript">
          function verclaseslg(valor) {
            if (valor=="proximaslg") {
              $('#pasadaslg').hide();
              $('#btnpasadaslg').addClass('btn-clases');$('#btnpasadaslg').removeClass('btn-success');
              $('#proximaslg').show();
              $('#btnproximaslg').addClass('btn-success');$('#btnproximaslg').removeClass('btn-clases');
            }
            if (valor=="pasadaslg") {
              $('#proximaslg').hide();
              $('#btnproximaslg').addClass('btn-clases');$('#btnproximaslg').removeClass('btn-success');
              $('#pasadaslg').show();
              $('#btnpasadaslg').addClass('btn-success');$('#btnpasadaslg').removeClass('btn-clases');
            }
          }
        </script>
      </div>

      <p>&nbsp;</p>
      <div id="proximaslg" class="listadeclases">
        <div class="list-group">
          @if ($user->ordenes)
            <?php
            $proximas= App\Orden::where('user_id', $user->id)->where('status', 'Proxima')->orderBy('fecha', 'asc')->get();
            if (!$proximas->isEmpty()) {
              date_default_timezone_set('America/Mexico_City');
              foreach ($proximas as $proxima) {

                $fecha=date_create($proxima->fecha);
                setlocale(LC_TIME, "es-ES");
               ?>
               <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                 @if($proxima->tipo=="particular")
                   <i class="fa fa-home" aria-hidden="true"></i>
                 @else
                   <i class="fa fa-building" aria-hidden="true"></i>
                 @endif
                 {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                 <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
               </a>
            <?php } } else{ ?>
              <p>No has tomado ninguna clase.</p>
              <?php  } ?>
          @endif

        </div>
      </div>
      <div id="pasadaslg" class="listadeclases" style="display:none;">
        <div class="list-group">
          @if ($user->ordenes)
            <?php
            $pasadas= App\Orden::where('user_id', $user->id)->where('status', 'Completa')->orWhere('status', 'Cancelada')->orderBy('fecha', 'desc')->get();
            if (!$pasadas->isEmpty()) {
              date_default_timezone_set('America/Mexico_City');
              foreach ($pasadas as $pasada) {

                $fecha=date_create($pasada->fecha);
                setlocale(LC_TIME, "es-ES");
               ?>
               <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                 @if ($pasada->status=="Cancelada")
                   <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                 @else
                   @if($pasada->tipo=="particular")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                  @endif
                 {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                 <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
               </a>
            <?php } } else{ ?>
              <p>No has tomado ninguna clase.</p>
              <?php  } ?>
          @endif

        </div>
      </div>
      </div>

    </div>
  </div>

</div>



@endsection

@section('modals')
<div class="modal fade" id="datosdeusuario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

      				<div>
      					<h4>Editar detalles</h4>
                <form action="{{ url('/actualizar-perfil') }}" method="post">
                  @if($user->detalles)
                    {{ method_field('PUT') }}
                  @endif
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					<input class="form-control datepicker" type="text" value="{{ $user->dob }}" name="dob" required>
                  <input class="form-control" type="tel" value="{{ $user->tel }}" placeholder="Teléfono (10 dígitos)" minlength="10" maxinlength="10" name="tel" required>
                  @if($user->detalles)
                    <input class="form-control" type="text" value="{{ $user->detalles->intereses }}" placeholder="Yoga, spinning, zumba..." name="intereses">

                  @else
                    <input class="form-control" type="text" value="" placeholder="Yoga, spinning, zumba..." name="intereses">

                  @endif

        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button>


                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal detalles user -->


<div class="modal fade" id="cambiarcontraseña" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

      				<div>
      					<h4>Actualizar contraseña</h4>
                <form action="{{ url('/actualizar-contraseña') }}" method="post">
                  {{ method_field('PUT') }}
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input class="form-control" type="password" name="password" placeholder="Nueva contraseña" required>
                  <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button>
                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal contraseña -->



<div class="modal fade" id="direcciones" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
              <button type="button" style="width: 100%" class="list-group-item" name="button" data-toggle="collapse" data-target="#direccionesguardadas" aria-expanded="false" aria-controls="direccionesguardadas">Tus direcciones</button>
              <div class="collapse" id="direccionesguardadas">
                @if (!$user->direcciones->isEmpty())
                  @foreach ($user->direcciones as $direccion)
                    <button style="width: 100%" class="btn btn-default" type="button" data-toggle="collapse" data-target="#direccion{{$direccion->id}}" aria-expanded="false" aria-controls="direccion{{$direccion->id}}">{{$direccion->identificador}}</button>
                    <div class="collapse" id="direccion{{$direccion->id}}">
                      <form action="{{ url('/actualizar-direccion') }}" method="post">
                        {{ method_field('PUT') }}
              					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="form-control" type="text" value="{{$direccion->identificador}}"  name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
                        <input class="form-control" type="text" value="{{$direccion->calle}}"  name="calle" placeholder="Calle" required>
                        <input class="form-control" type="text" value="{{$direccion->numero_ext}}"  name="numero_ext" placeholder="No. Ext" required>
                        <input class="form-control" type="text" value="{{$direccion->numero_int}}"  name="numero_int" placeholder="No. Int">
                        <input class="form-control" type="text" value="{{$direccion->colonia}}"  name="colonia" placeholder="Colonia" required>
                        <input class="form-control" type="text" value="{{$direccion->municipio_del}}" placeholder="Municipio/Delegación" name="municipio_del" required>
                        <input class="form-control" type="text" value="{{$direccion->cp}}" placeholder="Código postal" name="cp" required>
                        <select class="form-control" id="estado{{ $direccion->id }}"  name="estado" required>
                          <option value="">Estado</option>
                          <option value="CDMX">CDMX</option>
                          <option value="Edo. Méx">Edo. Méx</option>
                        </select>
                        <input type="hidden" value="{{ $direccion->id }}" name="direccion_id">
                        <script type="text/javascript">
                          if (document.getElementById('estado{{ $direccion->id }}') != null) document.getElementById('estado{{ $direccion->id }}').value = '{!! $direccion->estado !!}';
                        </script>
                        <div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $direccion->id }}').click();">Borrar</a>
                        </div>
                        <hr>
                      </form>
                      <form style="display: none;" action="{{ url('/eliminar-direccion') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="direccion_id" value="{{ $direccion->id }}">
                        <input type="submit" id="botoneliminar{{ $direccion->id }}">
                      </form>
                    </div>
                  @endforeach
                @else
                  <p>No tienes direcciones guardadas.</p>
                @endif



                <p>&nbsp;</p>
      				</div>
              <button type="button" style="width: 100%" class="well" name="button" data-toggle="collapse" data-target="#nuevadireccion" aria-expanded="false" aria-controls="nuevadireccion">Agregar dirección</button>
      				<div class="collapse" id="nuevadireccion">
                <form action="{{ url('/agregar-direccion') }}" method="post">
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input class="form-control" type="text" value="{{ old('identificador') }}"  name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
                  <input class="form-control" type="text" value="{{ old('calle') }}"  name="calle" placeholder="Calle" required>
                  <input class="form-control" type="text" value="{{ old('numero_ext') }}"  name="numero_ext" placeholder="No. Ext" required>
                  <input class="form-control" type="text" value="{{ old('numero_int') }}"  name="numero_int" placeholder="No. Int">
                  <input class="form-control" type="text" value="{{ old('colonia') }}"  name="colonia" placeholder="Colonia" required>
                  <input class="form-control" type="text" value="{{ old('municipio_del') }}" placeholder="Municipio/Delegación" name="municipio_del" required>
                  <input class="form-control" type="text" value="{{ old('cp') }}" placeholder="Código postal" name="cp" required>
                  <select class="form-control"  name="estado" required>
                    <option value="">Estado</option>
                    <option value="CDMX">CDMX</option>
                    <option value="Edo. Méx">Edo. Méx</option>
                  </select>
        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal contraseña -->


<div class="modal fade" id="agregartarjeta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
      				<div>
      					<h4>Agregar tarjeta</h4>
                <form action="{{ url('/agregar-tarjeta') }}" method="post">
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" placeholder="Ej: Crédito, Mi tarjeta, Banco ..." required>
                  <input class="form-control" type="num" value="{{ old('num') }}" name="num" placeholder="No. de tarjeta" required>
                  <select class="form-control" name="mes" required>
                   <option value="">Mes de exp.</option>
                   <option value="01">01</option>
                   <option value="02">02</option>
                   <option value="03">03</option>
                   <option value="04">04</option>
                   <option value="05">05</option>
                   <option value="06">06</option>
                   <option value="07">07</option>
                   <option value="08">08</option>
                   <option value="09">09</option>
                   <option value="10">10</option>
                   <option value="11">11</option>
                   <option value="12">12</option>
                 </select>
                 <select class="form-control" name="año" required>
                   <option value="">Año de exp.</option>
                   <option value="2017">2017</option>
                   <option value="2018">2018</option>
                   <option value="2019">2019</option>
                   <option value="2020">2020</option>
                   <option value="2021">2021</option>
                   <option value="2022">2022</option>
                   <option value="2023">2023</option>
                   <option value="2024">2024</option>
                   <option value="2025">2025</option>
                   <option value="2026">2026</option>
                   <option value="2027">2027</option>
                   <option value="2028">2028</option>
                 </select>
                 <input class="form-control" type="text" value="{{ old('nombre') }}" name="nombre" placeholder="Nombre del titular" required>
        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal contraseña -->

@if(!$user->tarjetas->isEmpty())
  @foreach ($user->tarjetas as $tarjeta)
    <div class="modal fade" id="tarjeta{{$tarjeta->id}}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-body">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

          				<div>
          					<h4>Editar tarjeta</h4>
                    <form action="{{ url('/actualizar-tarjeta') }}" method="post">

                      {{ method_field('PUT') }}

            					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input class="form-control" type="text" value="{{ Ucfirst($tarjeta->identificador) }}" name="identificador" placeholder="Ej: Crédito, Mi tarjeta, Banco ..." required>
                      <input class="form-control" type="num" value="{{ Ucfirst($tarjeta->num) }}" name="num" placeholder="No. de tarjeta" required>
                      <select class="form-control" id="mes{{ $tarjeta->id }}" name="mes" required>
                         <option value="">Mes de exp.</option>
                         <option value="01">01</option>
                         <option value="02">02</option>
                         <option value="03">03</option>
                         <option value="04">04</option>
                         <option value="05">05</option>
                         <option value="06">06</option>
                         <option value="07">07</option>
                         <option value="08">08</option>
                         <option value="09">09</option>
                         <option value="10">10</option>
                         <option value="11">11</option>
                         <option value="12">12</option>
                       </select>
                       <script type="text/javascript">
                         if (document.getElementById('mes{{ $tarjeta->id }}') != null) document.getElementById('mes{{ $tarjeta->id }}').value = '{!! $tarjeta->mes !!}';
                       </script>
                       <select class="form-control" id="año{{ $tarjeta->id }}" name="año" required>
                           <option value="">Año de exp.</option>
                           <option value="2017">2017</option>
                           <option value="2018">2018</option>
                           <option value="2019">2019</option>
                           <option value="2020">2020</option>
                           <option value="2021">2021</option>
                           <option value="2022">2022</option>
                           <option value="2023">2023</option>
                           <option value="2024">2024</option>
                           <option value="2025">2025</option>
                           <option value="2026">2026</option>
                           <option value="2027">2027</option>
                           <option value="2028">2028</option>
                         </select>
                         <script type="text/javascript">
                          if (document.getElementById('año{{ $tarjeta->id }}') != null) document.getElementById('año{{ $tarjeta->id }}').value = '{!! $tarjeta->año !!}';
                         </script>
                         <input class="form-control" type="text" value="{{ Ucfirst($tarjeta->nombre) }}" placeholder="Nombre del titular" name="nombre" required>
                         <input type="hidden" value="{{ $tarjeta->id }}" name="tarjeta_id">
                         <div class="text-center">
                           <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                           <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminart{{ $tarjeta->id }}').click();">Borrar</a>
                         </div>

                    </form>
                    <form style="display: none;" action="{{ url('/eliminar-tarjeta') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="tarjeta_id" value="{{ $tarjeta->id }}">
                        <input type="submit" id="botoneliminart{{ $tarjeta->id }}">
                      </form>
          				</div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal detalles user -->
  @endforeach
@endif





    <?php
    $proximas= App\Orden::where('user_id', $user->id)->where('status', 'Proxima')->orderBy('fecha', 'asc')->get();
    if (!$proximas->isEmpty()) {
      date_default_timezone_set('America/Mexico_City');
      foreach ($proximas as $proxima) {
        $coach = App\User::find($proxima->coach_id);
        if ($proxima->tipo=="residencial"){
          $dire=$proxima->direccion;
        }
        else{
          $direccion= App\Direccion::find($proxima->direccion);
          $dire=$direccion->identificador;
        }


        $fecha=date_create($proxima->fecha);
        setlocale(LC_TIME, "es-ES");

        $horadeclase = new DateTime($proxima->fecha . ' ' . $proxima->hora);
        $horaactual = new DateTime("now");
        $dteDiff  = $horaactual->diff($horadeclase);

        $dias=intval($dteDiff->format("%R%d"))*24;
        $horas=intval($dteDiff->format("%R%h"));
        $horastotales=$dias+$horas;


       ?>
       <div class="modal fade" id="proximas{{$proxima->id}}" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
           <div class="modal-content">

             <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
               <div class="container-bootstrap" style="width: 100%;">
                 <div class="row">
                   <div class="col-sm-4 sidebar">
                     <div class="text-center">
                            <h1>{{$proxima->nombre}}</h1>
                            <div class="profile-userpic">
                              <img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" class="img-responsive" alt="">
                            </div>
                            <?php $nombre=explode(" ",$coach->name); ?>
                            <h2>{{ucfirst($nombre[0])}}</h2>

                     </div>
                   </div>
                   <div class="col-sm-8">
                     <div class="title ">
                       {{Ucfirst($proxima->tipo)}}
                     </div>
                     <div class="gotham2">
                       <h2>Hora: {{$proxima->hora}}</h2>
                       <h2>Lugar: {{$dire}}</h2>
                     </div>
                   </div>
                   <div class="col-sm-12 text-center">
                     <p>&nbsp;</p>

                       <form class="" action="{{url('/cancelar-orden')}}" method="post">
                         {!! csrf_field() !!}
                         {{ method_field('PUT') }}
                         @if ($horastotales>=24)
                           <p class="text-center"><strong>IMPORTANTE</strong><br>
Texto de reembolso.
¿Estás seguro que deseas continuar?</p>
                           <input type="hidden" name="tipocancelacion" value="con">
                         @else
                           <p class="text-center"><strong>IMPORTANTE</strong><br>
Tu clase va a ser en menos de 24 horas. Si la cancelas no habrá ningún cambio o devolución por el servicio.
¿Estás seguro que deseas continuar?</p>
                           <input type="hidden" name="tipocancelacion" value="sin">
                         @endif
                         <input type="hidden" name="ordencancelar" value="{{$proxima->id}}">
                         <button type="submit" id="botoncancelar{{$proxima->id}}" class="btn btn-danger btn-lg" name="button" style="display:none;">Confirmar cancelación</button>
                       </form>
                       <button class="btn btn-danger btn-lg" id="botoncancelar2{{$proxima->id}}" name="button" onclick="javascript: document.getElementById('botoncancelar2{{$proxima->id}}').style.display='none'; document.getElementById('botoncancelar{{$proxima->id}}').style.display='inline-block'; ">Cancelar</button>



                   </div>
                 </div>
               </div>



             </div>
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal contraseña -->
    <?php } }?>






    <?php
    $pasadas= App\Orden::where('user_id', $user->id)->where('status', 'Completa')->orWhere('status', 'Cancelada')->orderBy('fecha', 'desc')->get();
    if (!$pasadas->isEmpty()) {
      date_default_timezone_set('America/Mexico_City');
      foreach ($pasadas as $pasada) {

        $coach = App\User::find($pasada->coach_id);
        if ($pasada->tipo=="residencial"){
          $dire=$pasada->direccion;
        }
        else{
          $direccion= App\Direccion::find($pasada->direccion);
          $dire=$direccion->identificador;
        }
        $fecha=date_create($pasada->fecha);
        setlocale(LC_TIME, "es-ES");


       ?>
       <div class="modal fade" id="pasadas{{$pasada->id}}" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
           <div class="modal-content">

             <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
               <div class="container-bootstrap" style="width: 100%;">
                 <div class="row">
                   <div class="col-sm-4 sidebar">
                     <div class="text-center">
                            <h1>{{$pasada->nombre}}</h1>
                            <div class="profile-userpic">
                              <img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" class="img-responsive" alt="">
                            </div>
                            <?php $nombre=explode(" ",$coach->name); ?>
                            <h2>{{ucfirst($nombre[0])}}</h2>

                     </div>
                   </div>
                   <div class="col-sm-8">
                     <div class="title ">
                       @if ($pasada->status=="Completa")
                         Completa
                       @endif
                       @if ($pasada->status=="Cancelada")
                         Cancelada
                       @endif
                     </div>
                     <div class="gotham2">
                       <h2>Hora: {{$pasada->hora}}</h2>
                       <h2>Lugar: {{$dire}}</h2>
                     </div>
                   </div>
                   <div class="col-sm-12 text-center">
                     <p>&nbsp;</p>
                     @if ($pasada->status=="Completa")
                       <form class="" action="{{url('/calificar-orden')}}" method="post">
                         {!! csrf_field() !!}
                         <input type="hidden" name="calificacion" value="">
                         <input type="hidden" name="orden_id" value="{{$pasada->id}}">
                         <button type="submit" class="btn btn-primary btn-lg" name="button">Calificar</button>
                       </form>
                     @endif


                   </div>
                 </div>
               </div>



             </div>
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal contraseña -->
    <?php } }?>


@endsection
