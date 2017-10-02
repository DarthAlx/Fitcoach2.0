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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">CLIENTES</div>
				</div>

			</div>
			<div class="row">

			</div>


			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Nombre</th>
			      <th>Email</th>
			      <th>Teléfono</th>
			      <th>DOB</th>
						<th>Genero</th>
						<th># Compradas</th>
						<th></th>
			  </tr>
			  </thead>
			  <tbody>


					@if ($usuarios)
						@foreach ($usuarios as $usuario)
							<tr style="cursor: pointer;">
						      <td>{{$usuario->name}}</td>
						      <td>{{$usuario->email}}</td>
						      <td>{{$usuario->tel}}</td>
						      <td>{{$usuario->dob}}</td>
									<td>{{$usuario->genero}}</td>
									<td>{{$usuario->ordenes->count()}}</td>
									<td><a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $usuario->id }}').click();">Borrar</a>
										<form style="display: none;" action="{{ url('/eliminar-cliente') }}" method="post">
								{!! csrf_field() !!}
								{{ method_field('DELETE') }}
								<input type="hidden" name="user_id" value="{{ $usuario->id }}">
								<input type="submit" id="botoneliminar{{ $usuario->id }}">
							</form>
						</td>
						  </tr>
						@endforeach
					@else
						<tr style="cursor: pointer;">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
						</tr>
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th>DOB</th>
					<th>Genero</th>
					<th># Compradas</th>
					<th></th>
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
