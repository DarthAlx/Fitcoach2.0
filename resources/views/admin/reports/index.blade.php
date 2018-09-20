@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="row profile">
	      <div class="col-sm-12">
	        @include('holders.notificaciones')
	      </div>
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-9">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">REPORTES</div>
				</div>
			</div>
			<br/>
			<div class="row" style="height: 300px">
				<div class="col-lg-4 col-lg-offset-4">
					<div class="dropdown">
						<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Escoje el reporte
							<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="/reportes/1">Clientes con clases por vencer</a></li>
							<li><a href="/reportes/2">Popularidad individual de clases</a></li>
							<li><a href="/reportes/3">Estatus de clases disponibles</a></li>
							<li><a href="/reportes/3">Uso de cupones</a></li>
							<li><a href="/reportes/3">Aforos detallados en Condominio</a></li>
							<li><a href="/reportes/3">Aforos Generales en condominio</a></li>
							<li><a href="/reportes/3">Cliente por clase</a></li>
							<li><a href="/reportes/3">Detalle de Clase COACH</a></li>
							<li><a href="/reportes/3">Detalle Ventas en Condominio</a></li>
							<li><a href="/reportes/3">Estado de cuenta cliente</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<p>&nbsp;</p>

  </div>
	</section>

