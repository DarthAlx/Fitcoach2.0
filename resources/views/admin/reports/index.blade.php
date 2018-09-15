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
			<div class="row">
				<div class="col-lg-4">
					<div class="dropdown">
						<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Escoje el reporte
							<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">HTML</a></li>
							<li><a href="#">CSS</a></li>
							<li><a href="#">JavaScript</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<p>&nbsp;</p>

  </div>
	</section>

