<!DOCTYPE html>
<html lang="es-mx">
	<head>
		<title>Fitcoach México | El club en tu casa</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="description" content="Nuestro objetivo es activar las áreas comunes de los condominios dándoles una administración de club deportivo. Actividades deportivas, culturales y sociales en la comodidad de tu casa.">
        <meta name="keywords" content="clases,deportivas,culturales,sociales,curso,verano,carrera,fitcoach,domicilio,instructores,profesores,deportes,interlomas,santa fe,areas,comunes">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<!--[if lte IE 8]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if lt IE 8]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="{{ url('css/bxslider.css') }}" media="screen" />
		<script src="https://use.fontawesome.com/a57ec16dec.js"></script>
		<link rel="stylesheet" type="text/css" href="{{ url('css/selectric.css') }}" media="screen" />
		<link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}" media="screen" />
		<link rel="stylesheet" type="text/css" href="{{ url('css/adaptive.css') }}" media="screen" />
		<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}" media="screen" />
		<link href="{{ url('css/select2.min.css') }}" rel="stylesheet" />
		<script type="text/javascript" src="{{ url('js/jquery-1.10.2.min.js') }}"></script>
		<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
		<script type="text/javascript" src="{{ url('js/vendor/bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/jquery.selectric.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/jquery.bxslider.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/script.js') }}"></script>
		<!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('js/datepicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('js/datepicker/css/bootstrap-datepicker.standalone.css')}}">
    <script src="{{asset('js/datepicker/js/bootstrap-datepicker.js')}}"></script>
		<link rel="stylesheet/less" type="text/css" href="{{asset('css/timepicker/timepicker.less')}}" />
    <!-- Languaje -->
    <script src="{{asset('js/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>


		<script type="text/javascript" src="{{asset('js/timepicker/bootstrap-timepicker.js')}}"></script>

		<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>




<script>


</script>

	</head>
<body class="home">
	<div class="pagecontainer">



   <header id="header"><div class="headerWrap clear is-sticky">
<a class="logo" id="logo" href="{{ url('/') }}">
        <img src="{{ url('images/logo-black.png') }}" alt="" width="161" height="46" class="logo-white">
        <img class="logo-black" src="{{ url('images/logo-black.png') }}" width="117" height="34" alt="">
</a>
			<nav class="mainMenu">
        <ul class="clear">
          <li class="menuclases"><a href="#">CLASES</a>
						<ul>
							<li><a href="{{ url('/clasesdeportivas') }}">Deportivas</a></li>
							<li><a href="#">Culturales</a></li>
							<li><a href="#">Eventos</a></li>
					  </ul>
					</li>
					@if (Auth::guest())
							<li><a href="#" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
					@else
						<li><a href="{{url('perfil')}}" data-toggle="tooltip" data-placement="bottom" title="Hola {{strtok(Auth::user()->name, " ")}}"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
						<li><a href="{{url('salir')}}"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a> </li>
					@endif

          <li><a href="{{url('/carrito')}}"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a></li>
          <li>
            <div id="nav-icon0" onclick="openNav()">
              <a href="#"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
            </div>
          </li>
        </ul>

		  </nav>


  </div></header>
  <div id="myNav" class="overlay">
    <!-- Button to close the overlay navigation -->
    <div class="container-bootstrap">
      <div id="nav-icon0" class="open" onclick="closeNav()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <!-- Overlay content -->
    <div class="overlay-content">
	     <a href="#">ACTIVACIÓN DE CONDOMINIOS</a>
      <a href="{{url('instructores')}}">INSTRUCTORES</a>
      <a href="#">RESERVAR</a>
      <a href="{{url('condominios')}}">CONDOMINIOS</a>
			<a href="#">¿QUIÉNES SOMOS?</a>
			<a href="#">LEGAL</a>
			<a href="#">CONTACTO</a>
    </div>

  </div>


  @yield('pagecontent')





  <footer id="footer" class="clear">

    <div class="footerSocial clear">
  			<a href="http://www.facebook.com/fitcoachmx"><i class="fa fa-facebook"></i></a>
  			<a href="http://www.twitter.com/fitcoachmx"><i class="fa fa-twitter"></i></a>
  			<a href="http://www.instagram.com/fitcoachmx"><i class="fa fa-instagram"></i></a>
  		</div>
  		<ul class="footerMenu clear">
  			<li><a href="{{ url('/aviso') }}">Aviso de Privacidad</a></li>
  			<li><a href="{{ url('/proximamente') }}">Términos y Condiciones</a></li>
  			<li><a href="{{ url('/proximamente') }}">Bolsa de Trabajo</a></li>

  		</ul>
  		<div class="footerSubscribe">
  			<form>
  				<input class="" type="text" name="" size="20" value="" placeholder="Email">
  				<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
  			</form>
  		</div>
  		<div class="copyright">
  			<p>Copyright &copy; 2015. FITCOACH México</p>
  		</div>

	</footer>
	</div>



	<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 col-lg-3 text-center centrartotal">
        <button type="button" class="close visible-xs" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
        <br><br>
				<div id="login1">
					<h4>Entrar o registrarse</h4>

					<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="login-username" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">
					<button id="btn-login"  class="btn btn-success" onclick="userExist()" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Entrar</button>

				</div>
				<div id="login2" style="display: none;">
					<h4>Bienvenido a Fitcoach</h4>
					<form id="loginform" class="form-horizontal" role="form" action="{{ url('/entrar') }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="emaillogin1" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
							<input id="passlogin1" type="password" class="form-control" name="password" placeholder="Contraseña" required>
							<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Entrar</button>
					</form>
				</div>
				<div id="login3" style="display: none;">
					<h4>Registrar una nueva cuenta</h4>
					<form id="loginform" class="form-horizontal" role="form" action="{{ url('/registro') }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="emaillogin2" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
							<input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}" placeholder="Confirmar correo electrónico" required>
							<input type="text" class="form-control" name="name" placeholder="Nombre" required>
							<input type="text" class="form-control datepicker" name="dob" placeholder="Fecha de nacimiento" required>
							<select class="form-control" name="genero" required>
								<option value="">Genero</option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
							<input type="tel" class="form-control" name="tel" minlength="10" placeholder="Teléfono (10 dígitos)" required>
							<input  type="password" class="form-control" name="password" placeholder="Contraseña" required>
							<input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña"  required>

							<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Entrar</button>
					</form>
				</div>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function userExist(){
	email = $('#login-username').val();
	_token= $('#token').val();
	$.post("{{url('/')}}/userExist", {
	email : email,
	_token : _token
	}, function(data) {
		 val = data;
			if (val=="true") {
				$('#login1').hide();
				$('#emaillogin1').val($('#login-username').val());
				$("#passlogin1").focus();
				$('#login2').show();
			}
			else{
				$('#login1').hide();
				$('#emaillogin2').val($('#login-username').val());
				$("#emailconflogin2").focus();
				$('#login3').show();
			}
	});
}
		</script>


    <script>
  (function (w,i,d,g,e,t,s) {w[d] = w[d]||[];t= i.createElement(g);
    t.async=1;t.src=e;s=i.getElementsByTagName(g)[0];s.parentNode.insertBefore(t, s);
  })(window, document, '_gscq','script','//widgets.getsitecontrol.com/12737/script.js');
</script>

<script src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".selector-horario").select2({
		placeholder: "Filtro",
		allowClear: true
	});
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
$('.mitimepicker').timepicker();
});


</script>
@yield('modals')
</body>
</html>
