@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap">
  <div class="topclear">
    &nbsp;
  </div>
  <div class="row profile">
      <div class="col-sm-12">
        @include('holders.notificaciones')
        <h2>Hola <span class="nombre">{{$user->name}}</span></h2>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4 sidebar">
      <hr>
      <div class="claseanterior text-center">
        <h4>CLASE ANTERIOR</h4>
        <h1>YOGA</h1>
        <h2>HERMAN</h2>
        <button type="button" class="btn btn-success">Calificar</button>
      </div>
      <hr>
      <h4>MIS DATOS</h4>
      <button type="button" class="btn" data-toggle="modal" data-target="#datosdeusuario"><span>Datos de usuario</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn"><span>Direcciones</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <button type="button" class="btn" data-toggle="modal" data-target="#cambiarcontraseña"><span>Contraseña</span> <i class="fa fa-pencil" aria-hidden="true"></i></button>
      <hr>
      <h4>FORMAS DE PAGO</h4>
      <button type="button" class="btn"><span>Mastercard</span></button>
      <button type="button" class="btn"><span>Nueva tarjeta +</span></button>
    </div>
    <div class="col-md-8">
      <hr>
      <div class="text-center">
        <button type="button" class="btn btn-success" style="display:inline-block; width:40%;">Proximas clases</button>
        <button type="button" class="btn btn-success" style="display:inline-block; width:40%;">Clases pasadas</button>
      </div>
      <p>&nbsp;</p>
      <div id="proximas" class="listadeclases">
        <div class="list-group">
          <a href="#" class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i> YOGA | 25 Julio | 20:00 <i class="fa fa-chevron-right pull-right" aria-hidden="true"></i></a>
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
                  <input class="form-control" type="tel" value="@if($user->detalles) {{ $user->detalles->tel }} @endif" placeholder="5555555555" name="tel" required>
                  <input class="form-control" type="text" value="@if($user->detalles) {{ $user->detalles->intereses }} @endif" placeholder="Yoga, spinning, zumba..." name="intereses">
        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button


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
        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button
                </form>
      				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal contraseña -->
@endsection
