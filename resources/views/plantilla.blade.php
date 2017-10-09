<!DOCTYPE html>
<html lang="es-mx">
	<head>
		<title>FITCOACH México | El club en tu casa</title>
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
		<link rel="stylesheet" href="{{ url('js/data-tables/DT_bootstrap.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('css/select2.min.css') }}" media="screen" />
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


<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107673883-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-107673883-1');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{
	if(f.fbq)return;n=f.fbq=function(){
	n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)
};
if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0
n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '141416126593810');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" src="https://www.facebook.com/tr?id=141416126593810&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

	</head>
<body class="home">
	<div class="pagecontainer">



   <header id="header"><div class="headerWrap clear is-sticky">
<a class="logo" id="logo" href="{{ url('/') }}">
        <img src="{{ url('images/Logo-FITCOACH.png') }}" alt="" width="161" height="46" class="logo-white">
        <img class="logo-black" src="{{ url('images/Logo-FITCOACH.png') }}" width="117" height="34" alt="">
</a>
			<nav class="mainMenu">
        <ul class="clear">
          <li class="menuclases"><a href="#">CLASES</a>
						<ul>
							<li><a href="{{ url('/clasesdeportivas') }}">Deportivas</a></li>
							<li><a href="{{ url('/clasesculturales') }}">Culturales</a></li>
							<li><a href="{{ url('/eventos') }}">Eventos</a></li>
					  </ul>
					</li>
					@if (Auth::guest())
							<li><a href="#" data-toggle="modal" data-target="#loginmodal" id="loginboton"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
					@elseif (Auth::user()->role=="usuario")
						<li><a href="{{url('perfil')}}" data-toggle="tooltip" data-placement="bottom" title="Hola {{strtok(Auth::user()->name, " ")}}"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
						<li><a href="{{url('salir')}}"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a> </li>
					@elseif (Auth::user()->role=="instructor")
						<li><a href="{{url('perfilinstructor')}}" data-toggle="tooltip" data-placement="bottom" title="Hola {{strtok(Auth::user()->name, " ")}}"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
						<li><a href="{{url('salir')}}"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a> </li>
					@elseif (Auth::user()->role=="admin"||Auth::user()->role=="superadmin")
						<li><a href="{{url('admin')}}" data-toggle="tooltip" data-placement="bottom" title="Hola {{strtok(Auth::user()->name, " ")}}"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> </li>
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
  <div id="myNav" class="overlay" style="z-index: 9999999999999;">
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
      <a href="{{url('coaches')}}">COACHES</a>
      <a href="{{url('/')}}#botones">RESERVAR</a>
      <a href="{{url('residenciales')}}">CONDOMINIOS</a>
			<a href="{{url('quienes-somos')}}">¿QUIÉNES SOMOS?</a>
			<a href="{{url('legales')}}">LEGAL</a>
			<a href="{{url('contacto')}}">CONTACTO</a>
    </div>

  </div>


  @yield('pagecontent')





  <footer id="footer" class="clear">

    <div class="footerSocial clear">
  			<a href="https://www.facebook.com/fitcoachmx"><i class="fa fa-facebook"></i></a>
  			<a href="https://www.twitter.com/fitcoachmx"><i class="fa fa-twitter"></i></a>
  			<a href="https://www.instagram.com/fitcoachmx"><i class="fa fa-instagram"></i></a>
  		</div>
  		<ul class="footerMenu clear text-center">
  			<li><a href="{{ url('/legales') }}?page=privacidad">Aviso de Privacidad</a></li>
  			<li><a href="{{ url('/legales') }}?page=terminos">Términos y Condiciones</a></li>
  			<li><a href="{{ url('/bolsa-de-trabajo') }}">Bolsa de Trabajo</a></li>

  		</ul>
  		<div class="footerSubscribe">
  			<form action="//fitcoach.us16.list-manage.com/subscribe/post?u=0b165717bbc98ca53d19e7bbf&amp;id=b27b9f9a8e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
  				<input class=""  type="email" value="" name="EMAIL" id="mce-EMAIL" size="20" value="" placeholder="Email">
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_0b165717bbc98ca53d19e7bbf_b27b9f9a8e" tabindex="-1" value=""></div>
  				<button id="mc-embedded-subscribe" class="btnSubscribe" type="submit"><i class="fa fa-envelope" aria-hidden="true"></i></button>
  			</form>
  		</div>
  		<div class="copyright">
  			<p>Copyright &copy; 2017. FITCOACH México</p>
  		</div>

	</footer>
	</div>



	<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-sm-3 col-lg-3 text-center centrartotal" style="cursor: default !important;">
        <button type="button" class="close visible-xs" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>
        <br><br>
				<div id="login1">
					<h4>Entrar o Registrarse</h4>

					<div style="color: #000; font-weight: 600; font-size: 18px;" id="errores">&nbsp;</div>

					<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="login-username" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">
					<button id="btn-login"  class="btn btn-success" onclick="userExist()" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Entrar</button>

				</div>
				<div id="login2" style="display: none;">
					<h4>Bienvenido a FITCOACH</h4>

					<form id="loginform" class="form-horizontal" role="form" action="{{ url('/entrar') }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="emaillogin1" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
							<input id="passlogin1" type="password" class="form-control" name="password" placeholder="Contraseña" required>
							<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Entrar</button>
							<small><a href="#" onclick="retrieve();">¿Olvidaste tu contraseña?</a></small>

					</form>
				</div>
				<div id="login3" style="display: none;">
					<h4>Registrar una nueva cuenta</h4>
					<form id="loginform" class="form-horizontal" role="form" action="{{ url('/registro') }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="emaillogin2" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
							<input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}" placeholder="Confirmar correo electrónico" required>
							<input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Nombre" required>
							<input type="text" class="form-control datepicker" value="{{ old('dob') }}" name="dob" placeholder="Fecha de nacimiento" required>
							<select class="form-control" name="genero" value="{{ old('genero') }}" required>
								<option value="">Genero</option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
							<input type="tel" class="form-control" name="tel" value="{{ old('tel') }}" minlength="10" placeholder="Teléfono (10 dígitos)" required>
							<input  type="password" class="form-control" name="password" placeholder="Contraseña" required>
							<input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña"  required>
							<div class="checkbox" style="padding: 10px 0;">
								<input type="checkbox" name="términos" value="Sí" required> <a href="{{url('/legales')}}?page=terminos" style="text-decoration: none; color: #000;">Acepto términos y condiciones y</a> <a href="{{url('/legales')}}?page=terminos" style="text-decoration: none; color: #000;">aviso de privacidad.</a>
							</div>

							<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Registrar</button>
					</form>
				</div>

				<div id="retrievepssw" style="display: none;">
					<h4>Recuperación de contraseña</h4>
          <form class="row" action="{{ url('/password/email ') }}" method="post">
    					<input class="form-control" type="email" value="{{ old('email') }}" placeholder="tu@email.com" name="email">
              {!! csrf_field() !!}
              <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Enviar</button>
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

function retrieve(){
	$('#login1').hide();
	$('#login2').hide();
	$('#login3').hide();
	$('#retrievepssw').show();
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

@if (count($errors)>0)
  <script type="text/javascript">

    @foreach ($errors->all() as $error)
      var inner=document.getElementById('errores').innerHTML;
      document.getElementById('errores').innerHTML=inner+"<span>{{ $error }}</span><br>";
    @endforeach
    document.getElementById('loginboton').click();
  </script>

@endif
<?php
if (isset($_GET['fromemail'])) {
	?>
	<script type="text/javascript">

    document.getElementById('loginboton').click();
  </script>
	<?php
}
 ?>

@yield('modals')
<!--dynamic table-->
<script type="text/javascript" language="javascript" src="{{ url('js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('js/data-tables/DT_bootstrap.js') }}"></script>
<!--dynamic table initialization -->
<script src="{{ url('js/dynamic_table_init.js') }}"></script>


<script type="text/javascript" src="{{ url('js/select2.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
$(".select").select2({
	placeholder: "Elige un usuario",
	allowClear: true
});
});
</script>
</body>
</html>
