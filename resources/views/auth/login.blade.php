@extends('plantilla')

@section('pagecontent')






     <div class="container-bootstrap">
       <div class="topclear">
         &nbsp;
       </div>
       <div class="col-xs-12">
         @include('holders.notificaciones')
       </div>
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info"  style="border-color: rgba(213, 134, 40, 0.64) !important;">
                    <div class="panel-heading" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                        <div class="panel-title text-center"><h3>INICIAR SESIÓN</h3></div>

                    </div>

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form id="loginform" class="form-horizontal" role="form" action="{{ url('/entrar') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        <input id="login-username" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">
                                    </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Contraseña">
                                    </div>



                            <div class="input-group text-center" style="display: block;">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" > Recordarme
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group text-center">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input id="btn-login" type="submit" class="btn btn-success" value="Entrar" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">


                                    </div>
                                </div>


                                <div class="form-group" style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                    <div class="col-md-6 control">
                                        <div  >
                                            ¿No tienes una cuenta?<br>
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()" style="color: #7f7f7f">
                                            Registrate aquí!
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 control">
                                        <div style="float:right;"><a href="{{ url('password/email') }}"  style="color: #7f7f7f">¿Olvidaste tu contraseña?</a></div>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" style="border-color: rgba(213, 134, 40, 0.64) !important;">
                        <div class="panel-heading" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                            <div class="panel-title text-center"><h3>Registrarse</h3></div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()" style="color: #fff;">Iniciar sesión</a></div>
                        </div>
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="{{ url('/registro') }}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-group">
                                  <label for="name" class="col-md-3 control-label">Nombre</label>
                                  <div class="col-md-9">
                                      <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                  </div>
                              </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Correo electrónico</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" placeholder="tu@email.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Contraseña</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Repetir contraseña</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña"  required>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-md-12 text-center">
                                        <input id="btn-signup" type="submit" class="btn btn-info" value="Registrar" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">

                                    </div>
                                </div>





                            </form>
                         </div>
                    </div>




         </div>
    </div>
@endsection
