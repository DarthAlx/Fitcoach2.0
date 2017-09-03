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
					<div class="title" style="font-size: 10vw;">VENTAS</div>
				</div>

			</div>
			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Nombre</th>
			      <th>Municipio</th>
			      <th>Estado / Departamento</th>
			      <th>Poblaci��n</th>
			      <th>Croquis</th>
			      <th>Persona de contacto</th>
			  </tr>
			  </thead>
			  <tbody>


			  <tr style="cursor: pointer;">
			      <td>a</td>
			      <td>a</td>
			      <td>a</td>
			      <td>a</td>
			      <td>a</td>
			      <td>a</td>
			  </tr>
				<tr style="cursor: pointer;">
			      <td>b</td>
			      <td>b</td>
			      <td>b</td>
			      <td>b</td>
			      <td>b</td>
			      <td>b</td>
			  </tr>

			  </tbody>
			  <tfoot>
			  <tr>
			    <th>Nombre</th>
			    <th>Municipio</th>
			    <th>Estado / Departamento</th>
			    <th>Poblaci��n</th>
			    <th>Croquis</th>
			    <th>Persona de contacto</th>
			  </tr>
			  </tfoot>
			  </table>

			  </div>
			</div>
		</div>
		<p>&nbsp;</p>

  </div>
	</section>
@endsection

@section('modals')

@endsection
