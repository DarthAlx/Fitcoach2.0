@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap-fluid">
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
        <h4 style="text-align: right">código de referencia: <strong>{{$user->code}}</strong></h4>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-lg-3 sidebar">
      <hr>
      <div class="claseanterior text-center">
        <h4>PENDIENTE POR PAGAR</h4>
        @if ($user->abonos)
          <?php
            $cantidad=0;
            foreach ($user->abonos as $pendiente) {
              $cantidad=$cantidad+$pendiente->abono;
            }
             ?>

             <h1>${{$cantidad}}</h1>

          @else
            <p>No has dado ninguna clase.</p>
        @endif
      </div>
      <div class="clasesperfil visible-xs">
        <hr>
        <div class="text-center row">
          <div class="col-xs-12"><button type="button" id="btnproximas" class="btn btn-success" style="display:inline-block; width:100%;" onclick="verclases('proximas')">Próximas clases</button></div>
          <div class="col-xs-12"><button type="button" id="btnpasadas" class="btn btn-clases" style="display:inline-block; width:100%;" onclick="verclases('pasadas')">Clases pasadas</button></div>
          <div class="col-xs-12"><button type="button" id="btnhistorial" class="btn btn-clases" style="display:inline-block; width:100%;" onclick="verclases('historial')">Historial de pagos</button></div>
          <script type="text/javascript">
            function verclases(valor) {
              if (valor=="proximas") {
                $('#pasadas').hide();
                $('#btnpasadas').addClass('btn-clases');$('#btnpasadas').removeClass('btn-success');
                $('#proximas').show();
                $('#btnproximas').addClass('btn-success');$('#btnproximas').removeClass('btn-clases');
                $('#historial').hide();
                $('#btnhistorial').addClass('btn-clases');$('#btnhistoriallg').removeClass('btn-success');
              }
              if (valor=="pasadas") {
                $('#proximas').hide();
                $('#btnproximas').addClass('btn-clases');$('#btnproximas').removeClass('btn-success');
                $('#pasadas').show();
                $('#btnpasadas').addClass('btn-success');$('#btnpasadas').removeClass('btn-clases');
                $('#historial').hide();
                $('#btnhistorial').addClass('btn-clases');$('#btnhistoriallg').removeClass('btn-success');
              }
              if (valor=="historial") {
                $('#proximas').hide();
                $('#pasadas').hide();
                $('#btnproximas').addClass('btn-clases');$('#btnproximas').removeClass('btn-success');
                $('#btnpasadas').addClass('btn-clases');$('#btnpasadas').removeClass('btn-success');
                $('#historial').show();
                $('#btnhistorial').addClass('btn-success');$('#btnhistorial').removeClass('btn-clases');
              }
            }
          </script>
        </div>
        <p>&nbsp;</p>
        <div id="proximas" class="listadeclases">
          <div class="list-group">
              <?php $array=array();
              $proximas= App\Reservacion::where('coach_id', $user->id)->where('status', 'Proxima')->orderBy('created_at', 'asc')->get();
              if (!$proximas->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($proximas as $proxima) {


                  $metadata= explode(',',$proxima->metadata);

                  $fecha=date_create($proxima->fecha);
                  setlocale(LC_TIME, "es-ES");
                 ?>

                  @if ($proxima->tipo=="En condominio")
                  @if (in_array($proxima->nombre.$proxima->fecha.$proxima->hora,$array))

                  <!--clase ya mostrada, no se hace nada-->
                  @else

                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                   @if($proxima->tipo=="A domicilio")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                   {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 <?php $array[]=$proxima->nombre.$proxima->fecha.$proxima->hora; ?>
                  @endif
                @else
                <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                   @if($proxima->tipo=="A domicilio")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                   {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 @endif

              <?php } } else{ ?>
                <p class="text-center">No has dado ninguna clase.</p>
                <?php  } ?>
          </div>
        </div>
        <div id="pasadas" class="listadeclases" style="display:none;">
          <div class="list-group">
              <?php  $array=array();

              $pasadas= App\Reservacion::where('coach_id', $user->id)->where('status', '<>', 'Proxima')->orderBy('created_at', 'desc')->get();
              if (!$pasadas->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($pasadas as $pasada) {
                  $fecha=date_create($pasada->fecha);
                  setlocale(LC_TIME, "es-ES");
                 ?>

                 @if ($pasada->tipo=="En condiminio")
                  @if (in_array($pasada->nombre.$pasada->fecha.$pasada->hora,$array))

                  <!--clase ya mostrada, no se hace nada-->
                  @else
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                   @if ($pasada->status=="Cancelada")
                     <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                   @else
                     @if($pasada->tipo=="A domicilio")
                       <i class="fa fa-home" aria-hidden="true"></i>
                     @else
                       <i class="fa fa-building" aria-hidden="true"></i>
                     @endif
                    @endif
                   {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>

                 <?php $array[]=$pasada->nombre.$pasada->fecha.$pasada->hora; ?>
                  @endif
                @else
                <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                   @if ($pasada->status=="Cancelada")
                     <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                   @else
                     @if($pasada->tipo=="A domicilio")
                       <i class="fa fa-home" aria-hidden="true"></i>
                     @else
                       <i class="fa fa-building" aria-hidden="true"></i>
                     @endif
                    @endif
                   {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 @endif
              <?php } } else{ ?>
                <p class="text-center">No has dado ninguna clase.</p>
                <?php  } ?>


          </div>
        </div>

        <div id="historial" class="listadeclases" style="display:none;">
          <div class="list-group">
              <?php
              $abonos= $user->abonos;

              if (!$abonos->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($abonos as $abono) {

                 ?>
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#abono{{$abono->id}}">
                     <i class="fa fa-plus" aria-hidden="true"></i>        
                   <?php setlocale(LC_TIME, "es_MX"); ?>
                   {{$abono->reservacion->nombre}} | {{$abono->reservacion->fecha}} {{$abono->reservacion->hora}} | Abono: ${{$abono->abono}} 
                   <!--i class="fa fa-chevron-right pull-right" aria-hidden="true"></i-->
                 </a>
              <?php 
                }  
              } else{ ?>
                <p class="text-center">No has recibido ningún abono.</p>
                <?php  }
               ?>

          </div>
        </div>

      </div>
      <hr>
      <h4>HORARIOS</h4>
      <button type="button" class="btn" data-toggle="modal" data-target="#horarionuevo"><span>Ver horarios</span> <i class="fa fa-calendar" aria-hidden="true"></i></button>
      <hr>
      <h4>MIS DATOS</h4>
      <button type="button" class="btn" data-toggle="modal" data-target="#datosdeusuario"><span>Datos de usuario</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#documentos"><span>Documentación</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#datosbancarios"><span>Pago</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#cambiarcontraseña"><span>Contraseña</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>

    </div>
    <div class="col-md-8 col-lg-9 hidden-xs">
      <hr>
      <div class="text-center row">
        <div class="col-sm-4"><button type="button" id="btnproximaslg" class="btn btn-success" style="display:inline-block; width:100%;" onclick="verclaseslg('proximaslg')">Próximas clases</button></div>
        <div class="col-sm-4"><button type="button" id="btnpasadaslg" class="btn btn-clases" style="display:inline-block; width:100%;" onclick="verclaseslg('pasadaslg')">Clases pasadas</button></div>
        <div class="col-sm-4"><button type="button" id="btnhistoriallg" class="btn btn-clases" style="display:inline-block; width:100%;" onclick="verclaseslg('historiallg')">Historial de pagos</button></div>
        <script type="text/javascript">
          function verclaseslg(valor) {
            if (valor=="proximaslg") {
              $('#pasadaslg').hide();
              $('#btnpasadaslg').addClass('btn-clases');$('#btnpasadaslg').removeClass('btn-success');
              $('#historiallg').hide();
              $('#btnhistoriallg').addClass('btn-clases');$('#btnhistoriallg').removeClass('btn-success');
              $('#proximaslg').show();
              $('#btnproximaslg').addClass('btn-success');$('#btnproximaslg').removeClass('btn-clases');
            }
            if (valor=="pasadaslg") {
              $('#proximaslg').hide();
              $('#btnproximaslg').addClass('btn-clases');$('#btnproximaslg').removeClass('btn-success');
              $('#historiallg').hide();
              $('#btnhistoriallg').addClass('btn-clases');$('#btnhistoriallg').removeClass('btn-success');
              $('#pasadaslg').show();
              $('#btnpasadaslg').addClass('btn-success');$('#btnpasadaslg').removeClass('btn-clases');
            }
            if (valor=="historiallg") {
                $('#proximaslg').hide();
                $('#pasadaslg').hide();
                $('#btnproximaslg').addClass('btn-clases'); $('#btnproximaslg').removeClass('btn-success');
                $('#btnpasadaslg').addClass('btn-clases'); $('#btnpasadaslg').removeClass('btn-success');
                $('#btnhistoriallg').addClass('btn-success');$('#btnhistoriallg').removeClass('btn-clases');
                $('#historiallg').show();
              }
          }
        </script>
      </div>
      <p>&nbsp;</p>
      <div id="proximaslg" class="listadeclases">
        <div class="list-group">
            <?php $array=array();
            $proximas= App\Reservacion::where('coach_id', $user->id)->where('status', 'Proxima')->orderBy('created_at', 'asc')->get();
            if (!$proximas->isEmpty()) {
              date_default_timezone_set('America/Mexico_City');
              foreach ($proximas as $proxima) {
                $metadata= explode(',',$proxima->metadata);

                $fecha=date_create($proxima->fecha);
                setlocale(LC_TIME, "es-ES");
               ?>
                
@if ($proxima->tipo=="En condominio")
                  @if (in_array($proxima->nombre.$proxima->fecha.$proxima->hora,$array))

                  <!--clase ya mostrada, no se hace nada-->
                  @else

                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                   @if($proxima->tipo=="A domicilio")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                   {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                   <i class="fa fa-list" aria-hidden="true"></i>
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 <?php $array[]=$proxima->nombre.$proxima->fecha.$proxima->hora; ?>
                  @endif
                @else
                <a href="#" class="list-group-item" data-toggle="modal" data-target="#proximas{{$proxima->id}}">
                   @if($proxima->tipo=="A domicilio")
                     <i class="fa fa-home" aria-hidden="true"></i>
                   @else
                     <i class="fa fa-building" aria-hidden="true"></i>
                   @endif
                   {{$proxima->nombre}} | {{strftime("%d %B", strtotime($proxima->fecha))}} | {{ $proxima->hora }}
                   <i class="fa fa-list" aria-hidden="true"></i>
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 @endif
            <?php } } else{ ?>
              <p class="text-center">No has dado ninguna clase.</p>
              <?php  } ?>
        </div>
      </div>
      <div id="pasadaslg" class="listadeclases" style="display:none;">
        <div class="list-group">
            <?php $array=array();
            $pasadas= App\Reservacion::where('coach_id', $user->id)->where('status', '<>', 'Proxima')->orderBy('created_at', 'desc')->get();
            if (!$pasadas->isEmpty()) {
              date_default_timezone_set('America/Mexico_City');
              foreach ($pasadas as $pasada) {
                $fecha=date_create($pasada->fecha);
                setlocale(LC_TIME, "es-ES");
               ?>
              
@if ($pasada->tipo=="En condominio")
                  @if (in_array($pasada->nombre.$pasada->fecha.$pasada->hora,$array))

                  <!--clase ya mostrada, no se hace nada-->
                  @else
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                   @if ($pasada->status=="Cancelada")
                     <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                   @else
                     @if($pasada->tipo=="A domicilio")
                       <i class="fa fa-home" aria-hidden="true"></i>
                     @else
                       <i class="fa fa-building" aria-hidden="true"></i>
                     @endif
                    @endif
                   {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>

                 <?php $array[]=$pasada->nombre.$pasada->fecha.$pasada->hora; ?>
                  @endif
                @else
                <a href="#" class="list-group-item" data-toggle="modal" data-target="#pasadas{{$pasada->id}}">
                   @if ($pasada->status=="Cancelada")
                     <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                   @else
                     @if($pasada->tipo=="A domicilio")
                       <i class="fa fa-home" aria-hidden="true"></i>
                     @else
                       <i class="fa fa-building" aria-hidden="true"></i>
                     @endif
                    @endif
                   {{$pasada->nombre}} | {{strftime("%d %B", strtotime($pasada->fecha))}} | {{ $pasada->hora }}
                   <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
                 </a>
                 @endif
            <?php } } else{ ?>
              <p class="text-center">No has dado ninguna clase.</p>
              <?php  } ?>


        </div>
      </div>
      <div id="historiallg" class="listadeclases" style="display:none;">
          <div class="list-group">
              <?php
              $abonos= $user->abonos;

              if (!$abonos->isEmpty()) {
                date_default_timezone_set('America/Mexico_City');
                foreach ($abonos as $abono) {

                 ?>
                 <a href="#" class="list-group-item" data-toggle="modal" data-target="#abono{{$abono->id}}">
                     <i class="fa fa-plus" aria-hidden="true"></i>        
                   <?php setlocale(LC_TIME, "es_MX"); ?>
                   {{$abono->reservacion->nombre}} | {{$abono->reservacion->fecha}} {{$abono->reservacion->hora}} | Abono: ${{$abono->abono}} 
                   <!--i class="fa fa-chevron-right pull-right" aria-hidden="true"></i-->
                 </a>
              <?php 
                }  
              } else{ ?>
                <p class="text-center">No has recibido ningún abono.</p>
                <?php  }
               ?>

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
        					<input class="form-control datepicker" type="text" value="{{ $user->dob }}" placeholder="Fecha de nacimiento" name="dob" required>
                  <input class="form-control" type="tel" value="{{ $user->tel }}" placeholder="Teléfono (10 dígitos)" name="tel" minlength="10" maxlength="10" required>
                  @if($user->detalles)

                    <input class="form-control" type="text" value="{{ $user->detalles->rfc }}" placeholder="RFC" name="rfc">
                  @else

                    <input class="form-control" type="text" value="" placeholder="RFC" name="rfc">
                  @endif

        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button>


                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal detalles user -->


<div class="modal fade" id="datosbancarios" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

      				<div>
      					<h4>Editar datos bancarios</h4>
                <form action="{{ url('/actualizar-bancarios') }}" method="post">
                  @if($user->bancarios)
                    {{ method_field('PUT') }}
                  @endif
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">


                  @if($user->bancarios)
                    <input class="form-control" type="text" value="{{ $user->bancarios->banco }}" placeholder="Banco" name="banco" required>
                    <input class="form-control" type="text" value="{{ $user->bancarios->cta }}" placeholder="Cuenta" name="cta" required>
                    <input class="form-control" type="text" value="{{ $user->bancarios->clabe }}" placeholder="CLABE" name="clabe" required>
                    <input class="form-control" type="text" value="{{ $user->bancarios->tarjeta }}" placeholder="Tarjeta" name="tarjeta" required>
                    <textarea class="form-control" placeholder="Información adicional" name="adicional" required>{{ $user->bancarios->adicional }}</textarea>

                  @else

                    <input class="form-control" type="text" value="{{ old('banco') }}" placeholder="Banco" name="banco" required>
                    <input class="form-control" type="text" value="{{ old('cta') }}" placeholder="Cuenta" name="cta" required>
                    <input class="form-control" type="text" value="{{ old('clabe') }}" placeholder="CLABE" name="clabe" required>
                    <input class="form-control" type="text" value="{{ old('tarjeta') }}" placeholder="Tarjeta" name="tarjeta" required>
                    <textarea class="form-control" placeholder="Información adicional" name="adicional" required>{{ old('adicional') }}</textarea>

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



<div class="modal fade" id="horarionuevo" tabindex="-1" role="dialog">
  <?php $permitidas = explode(",",$user->detalles->clases);

        $clases = App\Clase::whereIn('id', $permitidas)->get(); 
        $particulares = App\Reservacion::where('coach_id',$user->id)->get();
        ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
              <button type="button" style="width: 100%" class="list-group-item" name="button" data-toggle="collapse" data-target="#horariosguardados" aria-expanded="false" aria-controls="horariosguardados">Tus horarios</button>
              <div class="collapse" id="horariosguardados">

                @if (!$particulares->isEmpty())
                  @foreach ($particulares as $particular)
                    <button style="width: 100%" class="btn btn-default" type="button" data-toggle="collapse" data-target="#horario{{$particular->id}}" aria-expanded="false" aria-controls="horario{{$particular->id}}">

                      <?php
                                        $recurrencias = explode(",",$particular->recurrencia);
                                    ?>
                      {{$particular->nombre}} -
                      @if ($particular->recurrencia)

                        @if (in_array("0", $recurrencias))
                          Dom
                        @endif
                        @if (in_array("1", $recurrencias))
                          Lun
                        @endif
                        @if (in_array("2", $recurrencias))
                          Mar
                        @endif
                        @if (in_array("3", $recurrencias))
                          Miér
                        @endif
                        @if (in_array("4", $recurrencias))
                          Jue
                        @endif
                        @if (in_array("5", $recurrencias))
                          Vie
                        @endif
                        @if (in_array("6", $recurrencias))
                          Sab
                        @endif

                      @else
                        {{$particular->fecha}}
                      @endif
                       - {{$particular->hora}}

                    </button>
                    <div class="collapse" id="horario{{$particular->id}}">
                      <form action="{{ url('/actualizar-horario') }}" method="post">
                        {{ method_field('PUT') }}
                        <select class="form-control" id="clase{{ $particular->id }}" name="clase_id" required>
                         <option value="">Selecciona una clase</option>
                         @foreach ($clases as $clase)
                           <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                         @endforeach
                       </select>
                       <script type="text/javascript">
                         if (document.getElementById('clase{{ $particular->id }}') != null) document.getElementById('clase{{ $particular->id }}').value = '{!! $particular->clase_id !!}';
                       </script>

                        <input class="form-control datepicker" type="text" placeholder="Fecha (si no es recurrente)" value="{{ $particular->fecha }}" name="fecha">
                        <input value="{{ $particular->hora }}" class="form-control xmitimepicker" type="text" name="hora" required  placeholder="Hora" / >
                        <label>Recurrencia</label>
                        <div class="checkbox">
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}1" name="recurrencia[]"  value="1">L &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}2" name="recurrencia[]"  value="2">M &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}3" name="recurrencia[]"  value="3">M &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}4" name="recurrencia[]"  value="4">J &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}5" name="recurrencia[]"  value="5">V &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}6" name="recurrencia[]"  value="6">S &nbsp;  &nbsp;  </label>
                          <label><input type='checkbox' class="recurrentes" id="check{{$particular->id}}0" name="recurrencia[]"  value="0">D &nbsp;  &nbsp;  </label>
                        </div>

                                     <script type="text/javascript">
                                       @foreach ($recurrencias as $recurrencia)
                                         document.getElementById('check{{$particular->id}}{{$recurrencia}}').checked = true;
                                       @endforeach
                                     </script>

                        <select class="form-control" name="zona_id"  id="zona{{$particular->id}}" required>
                          <option value="">Selecciona una zona</option>
                          <?php $zonas=App\Zona::all(); ?>
                          @foreach ($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ ucfirst($zona->identificador) }}</option>
                          @endforeach
                        </select>
                        <script type="text/javascript">
                          if (document.getElementById('zona{{ $particular->id }}') != null) document.getElementById('zona{{ $particular->id }}').value = '{!! $particular->zona_id !!}';
                        </script>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="horario_id" value="{{ $particular->id }}">
                        <div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $particular->id }}').click();">Borrar</a>
                        </div>
                        <hr>
                      </form>
                      <form style="display: none;" action="{{ url('/eliminar-horario') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="horario_id" value="{{ $particular->id }}">
                        <input type="submit" id="botoneliminar{{ $particular->id }}">
                      </form>
                    </div>
                  @endforeach
                @else
                  <p>No tienes horarios guardados.</p>
                @endif



                <p>&nbsp;</p>
              </div>
              <button type="button" style="width: 100%" class="well" name="button" data-toggle="collapse" data-target="#nuevohorario" aria-expanded="false" aria-controls="nuevohorario">Agregar horario</button>
              <div class="collapse" id="nuevohorario">
              <div>

      					<h4>Agregar horario</h4>
                <form action="{{ url('/agregar-horario') }}" method="post">
                  <select class="form-control"  name="clase_id" required>
                   <option value="">Selecciona una clase</option>
                   @foreach ($clases as $clase)
                     <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                   @endforeach
                 </select>
                  <input class="form-control datepicker" type="text" placeholder="Fecha (si no es recurrente)" name="fecha">
                  <input value="{{ old('hora') }}" class="form-control xmitimepicker" type="text" name="hora" required  placeholder="Hora" / >
                  <label>Recurrencia</label>
                  <div class="checkbox">
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="1">L &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="2">M &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="3">M &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="4">J &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="5">V &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="6">S &nbsp;  &nbsp;  </label>
                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="0">D &nbsp;  &nbsp;  </label>
                  </div>
                  <select class="form-control" name="zona_id" required>
                    <option value="">Selecciona una zona</option>
                    <?php $zonas=App\Zona::all(); ?>
                    @foreach ($zonas as $zona)
                      <option value="{{ $zona->id }}">{{ ucfirst($zona->identificador) }}</option>
                    @endforeach
                  </select>
                  {!! csrf_field() !!}
                  <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
                </form>
      				</div>
              </div>
              <button type="button" style="width: 100%" class="list-group-item" name="button" data-toggle="collapse" data-target="#libres" aria-expanded="false" aria-controls="libres">Días libres</button>
              <div class="collapse" id="libres">

                <div>

                  @if(!$user->libres->isEmpty())
                  @foreach($user->libres as $libre)
                  <table class="table">
                    <tr>
                      <th>Día</th>
                      <th>Eliminar</th>
                    </tr>
                    <tr>
                      <td>
                        {{$libre->fecha}}
                      </td>
                      <td>
                        <form  action="{{ url('/eliminar-libre') }}" method="post">
                          {!! csrf_field() !!}
                          {{ method_field('DELETE') }}
                          <input type="hidden" name="libre_id" value="{{ $libre->id }}">
                          <button type="submit" class="btn btn-danger" id="botoneliminar{{ $libre->id }}">Eliminar</button>
                        </form>
                      </td>
                    </tr>
                  </table>
                  
                  
                  @endforeach
                  @else
                  Aún no tienes días libres
                  @endif
                </div>
              </div>



              <button type="button" style="width: 100%" class="well" name="button" data-toggle="collapse" data-target="#nuevolibre" aria-expanded="false" aria-controls="nuevolibre">Nuevo día libre</button>
              <div class="collapse" id="nuevolibre">
                <div>

                  <h4>Agregar día libre</h4>
                  <form action="{{ url('/agregar-libre') }}" method="post">
                    <input class="form-control datepicker" type="text" placeholder="Fecha (si no es recurrente)" name="fecha">
                    {!! csrf_field() !!}
                    <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
                  </form>
                </div>
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
    $proximas= App\Reservacion::where('coach_id', $user->id)->where('status', 'Proxima')->orderBy('created_at', 'asc')->get();


    if (!$proximas->isEmpty()) {
      date_default_timezone_set('America/Mexico_City');
      foreach ($proximas as $proxima) { ?>
        <div class="modal fade" id="plan{{$proxima->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
 
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
                  <div class="container-bootstrap" style="width: 100%;">


                      <h4>Subir documentación</h4>
                      <form action="{{ url('/planear-clase') }}" method="post" enctype="multipart/form-data">
                        @if($proxima->plan)
                          {{ method_field('PUT') }}
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
      
                        @if(!$proxima->plan)
  
                          <label>Fase inicial</label>
                          <textarea name="inicio" class="form-control" cols="30" rows="10"></textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosinicio">

                          <label>Fase medular</label>
                          <textarea name="medular" class="form-control" cols="30" rows="10"></textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosmedular">

                          <label>Fase final</label>
                          <textarea name="final" class="form-control" cols="30" rows="10"></textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosfinal">

                          <label>Comentarios</label>
                          <textarea name="comentarios" class="form-control" cols="30" rows="10"></textarea>
                          <input type="hidden" name="reservacion_id" value="{{$proxima->id}}">


                          
                        @else
                        {{$proxima->plan}}
  
                          <label>Fase inicial</label>
                          <textarea name="inicio" class="form-control" cols="30" rows="10">{{$proxima->plan->inicio}}</textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosinicio" value="{{$proxima->plan->minutosinicio}}">

                          <label>Fase medular</label>
                          <textarea name="medular" class="form-control" cols="30" rows="10">{{$proxima->plan->medular}}</textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosmedular" value="{{$proxima->plan->minutosmedular}}">

                          <label>Fase final</label>
                          <textarea name="final" class="form-control" cols="30" rows="10">{{$proxima->plan->final}}</textarea>
                          <label>Minutos</label>
                          <input type="number" class="form-control" name="minutosfinal" value="{{$proxima->plan->minutosfinal}}">

                          <label>Comentarios</label>
                          <textarea name="comentarios" class="form-control" cols="30" rows="10">{{$proxima->plan->comentarios}}</textarea>
                          <input type="hidden" name="reservacion_id" value="{{$proxima->id}}">
      
                        @endif
      
                        <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
      
      
                      </form>

                  </div>
              </div>
            </div>
          </div>
        </div>













        <?php
        $cliente = App\User::find($proxima->user_id);
        if ($proxima->tipo=="En condominio"){
          $dire=$proxima->direccion;
        }
        else{
          $direccion= App\Direccion::find($proxima->direccion);
          $dire=$direccion->calle. " " .
$direccion->numero_ext. " " .
$direccion->numero_int. ", " .
$direccion->colonia. ", " .
$direccion->municipio_del. ", " .
$direccion->cp. ", " .
$direccion->estado;
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
                            <?php $nombre=explode(" ",$cliente->name); 
                            if ($proxima->tipo=="En condominio") {
                              $clientesporclase=App\Reservacion::where('nombre', $proxima->nombre)->where('fecha', $proxima->fecha)->orderBy('nombre', 'asc')->get();
                            
                              foreach ($clientesporclase as $clienteporclase) {
                                echo $clienteporclase->user->name."<br>";
                              }
                            }else{
                              ?>
                              <h2>{{ucfirst($nombre[0])}}</h2>
                              <?php
                            }
                            
                            ?>
                          

                     </div>
                   </div>
                   <div class="col-sm-8">
                     <div class="title ">
                       {{Ucfirst($proxima->tipo)}}
                     </div>
                     <div class="gotham2">
                       <h2>Fecha: {{$proxima->fecha}}</h2>
                       <h2>Hora: {{$proxima->hora}}</h2>
                       <h2>Lugar: {{ $dire }}</h2>
                       <h2>Teléfono: {{ $proxima->user->tel }}</h2>
                     </div>
                   </div>
                   <div class="col-sm-12 text-center">
                     <p>&nbsp;</p>

                       <form class="" action="{{url('/terminar-orden')}}" method="post">
                         {!! csrf_field() !!}
                         {{ method_field('PUT') }}
                          <input type="hidden" name="revision" value="{{$proxima->id}}">
                          <input type="text" id="aforo{{$proxima->id}}" name="aforo" class="form-control" placeholder="Aforo" style="display:none; width: 30%" required><br>

                         <button type="submit" id="botonmandar{{$proxima->id}}" class="btn btn-primary btn-lg" name="button" style="display:none;">¿Mandar a revisión?</button>
                       </form>
                       <button class="btn btn-primary btn-lg" id="botonmandar2{{$proxima->id}}" name="button" onclick="javascript: document.getElementById('botonmandar2{{$proxima->id}}').style.display='none'; document.getElementById('botonmandar{{$proxima->id}}').style.display='inline-block'; document.getElementById('aforo{{$proxima->id}}').style.display='inline-block'; ">Terminar</button>



                   </div>
                 </div>
               </div>



             </div>
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal contraseña -->
    <?php } }?>






    <?php

$pasadas= App\Reservacion::where('coach_id', $user->id)->where('status', '<>', 'Proxima')->orderBy('created_at', 'desc')->get();

    if (!$pasadas->isEmpty()) {
      date_default_timezone_set('America/Mexico_City');
      foreach ($pasadas as $pasada) {
        $cliente = App\User::find($pasada->user_id);
        $direccion= App\Direccion::find($pasada->direccion);
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
                            <?php $nombre=explode(" ",$cliente->name); 
                            if ($pasada->tipo=="En condominio") {
                             
                            }else{
                              ?>
                              <h2>{{ucfirst($nombre[0])}}</h2>
                              <?php
                            }
                            
                            ?>

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
                       @if ($pasada->status=="Porrevisar")
                         Por revisar
                       @endif
                     </div>
                     <div class="gotham2">
                       <h2>Fecha: {{$pasada->fecha}}</h2>
                       <h2>Hora: {{$pasada->hora}}</h2>

                     </div>
                   </div>
                 </div>
               </div>



             </div>
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal contraseña -->
    <?php } }?>









    <div class="modal fade" id="documentos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
    
          <div class="modal-body">
    
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
    
                  <div>
                    <h4>Subir documentación</h4>
                    <form action="{{ url('/subir-documentacion') }}" method="post" enctype="multipart/form-data">
                      @if($user->documentacion)
                        {{ method_field('PUT') }}
                      @endif
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    
                      @if($user->documentacion)

                        <label>Cédula de Identificación Fiscal (RFC)</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->rfc }}" placeholder="Cédula de Identificación Fiscal (RFC)" name="rfc" required>
                        <label>Credencial de Elector (INE)</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->ine }}" placeholder="Credencial de Elector (INE)" name="ine" required>
                        <label>Clave Única de Registro de Población (CURP)</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->curp }}" placeholder="Clave Única de Registro de Población (CURP)" name="curp" required>
                        <label>Acta de Nacimiento</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->acta }}" placeholder="Acta de Nacimiento" name="acta" required>
                        <label>Comprobante de domicilio</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->domicilio }}" placeholder="Comprobante de domicilio" name="domicilio" required>
                        <label>Certificaciones</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->certificaciones }}" placeholder="Certificaciones" name="certificaciones" required>
                        <label>Carta de recomendación 1</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->recomendacion1 }}" placeholder="Carta de recomendación 1" name="recomendacion1" required>
                        <label>Carta de recomendación 2</label>
                        <input class="form-control" type="file" value="{{ $user->documentacion->recomendacion2 }}" placeholder="Carta de recomendación 2" name="recomendacion2" required>
                      @else

                        <label>Cédula de Identificación Fiscal (RFC)</label>
                        <input class="form-control" type="file" value="{{ old('rfc') }}" placeholder="Cédula de Identificación Fiscal (RFC)" name="rfc" required>
                        <label>Credencial de Elector (INE)</label>
                        <input class="form-control" type="file" value="{{ old('ine') }}" placeholder="Credencial de Elector (INE)" name="ine" required>
                        <label>Clave Única de Registro de Población (CURP)</label>
                        <input class="form-control" type="file" value="{{ old('curp') }}" placeholder="Clave Única de Registro de Población (CURP)" name="curp" required>
                        <label>Acta de Nacimiento</label>
                        <input class="form-control" type="file" value="{{ old('acta') }}" placeholder="Acta de Nacimiento" name="acta" required>
                        <label>Comprobante de domicilio</label>
                        <input class="form-control" type="file" value="{{ old('domicilio') }}" placeholder="Comprobante de domicilio" name="domicilio" required>
                        <label>Certificaciones</label>
                        <input class="form-control" type="file" value="{{ old('certificaciones') }}" placeholder="Certificaciones" name="certificaciones" required>
                        <label>Carta de recomendación 1</label>
                        <input class="form-control" type="file" value="{{ old('recomendacion1') }}" placeholder="Carta de recomendación 1" name="recomendacion1" required>
                        <label>Carta de recomendación 2</label>
                        <input class="form-control" type="file" value="{{ old('recomendacion2') }}" placeholder="Carta de recomendación 2" name="recomendacion2" required>
    
                      @endif
    
                      <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
    
    
                    </form>
                  </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal detalles user -->


@endsection
