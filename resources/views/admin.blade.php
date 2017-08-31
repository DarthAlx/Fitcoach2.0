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


</div>



@endsection

@section('modals')
  <div class="modal fade" id="datosdeusuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

        				<div>
        					<h4>Nuevo usuario</h4>
                  <form action="{{ url('/agregar-usuario') }}" method="post">
          					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="form-control" type="text" value="{{ old('name') }}" placeholder="Nombre" name="name" required>
                    <input class="form-control" type="text" value="{{ old('email') }}" placeholder="Correo electrónico" name="email" required>
                    <input class="form-control" type="text" placeholder="Contraseña" name="password" required>
                    <input class="form-control" type="text" placeholder="Confirmar contraseña" name="password_confirmation" required>
                    <input class="form-control" type="text" value="{{ old('puesto') }}" placeholder="Puesto" name="puesto" required>
          					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
                  </form>
        				</div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal detalles user -->
@endsection
