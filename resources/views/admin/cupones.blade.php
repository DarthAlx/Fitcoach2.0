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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">CUPONES</div>
				</div>

			</div>
			<p>&nbsp;</p><p>&nbsp;</p>
			<div class="row">
				<button type="button" name="button" class="btn btn-default" data-toggle="modal" data-target="#cupon">+ Agregar cupon</button>

			</div>


			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Código</th>
			      <th>Descripción</th>
						<th>Monto</th>
			      <th>Maximos usos</th>
			      <th>Monto minimo</th>
						<th>Fecha de expiración</th>
						<th>Acciones</th>
			  </tr>
			  </thead>
			  <tbody>


					@if ($cupones)
						@foreach ($cupones as $cupon)
							<tr style="cursor: pointer;">
						      <td>{{$cupon->codigo}}</td>
						      <td>{{$cupon->descripcion}}</td>
									<td>{{$cupon->monto}}</td>
						      <td>{{$cupon->usos}}</td>
						      <td>{{$cupon->minimo}}</td>
									<td>{{$cupon->expiracion}}</td>
									<td>
										<button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#cupon{{$cupon->id}}">Editar</button>
										<a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $cupon->id }}').click();">Borrar</a>
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
					<th>Código</th>
					<th>Descripción</th>
					<th>Monto</th>
					<th>Maximos usos</th>
					<th>Monto minimo</th>
					<th>Expiración</th>
					<th>Acciones</th>
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



	<div class="modal fade" id="cupon" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-body">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

								<div>
									<h4>Agregar cupon</h4>
									<form action="{{ url('/agregar-cupon') }}" method="post">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" placeholder="Descripción" required>
										<input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}" placeholder="Código" required>
										<input type="text" name="monto" class="form-control" value="{{ old('monto') }}" placeholder="Monto" required>
										<input type="number" name="usos" class="form-control" value="{{old('usos')}}" placeholder="Maximos usos" required>
										<input type="number" name="minimo" class="form-control" value="{{old('minimo')}}" placeholder="Monto minimo" required>
										<input class="form-control datepicker" type="text" placeholder="Fecha de expiración" value="{{old('expiracion')}}" name="expiracion" required>
										<select class="form-control" name="tipo">
											<option value="">Tipo de clase</option>
											<option value="Deportiva">Deportiva</option>
											<option value="Cultural">Cultural</option>
											<option value="Residencial">Residencial</option>
											<option value="Evento">Evento</option>
										</select>
										<?php $usuarios=App\User::where('role', 'usuario')->orderBy('name', 'asc')->get(); ?>
										<select class="form-control" name="user_id">
											<option value="">Usuario</option>
											@foreach ($usuarios as $usuario)
												<option value="{{$usuario->id}}">{{ucfirst($usuario->name)}} - {{$usuario->email}}</option>
											@endforeach
										</select>
										<input type="number" name="maximo" class="form-control" value="{{old('maximo')}}" placeholder="Uso maximo general">
										<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Crear</button>
									</form>
								</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal pago-->




	@if ($cupones)
		@foreach ($cupones as $cupon)
			<div class="modal fade" id="cupon{{$cupon->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Editar cupon</h4>
											<?php $usos=App\Cuponera::where('cupon_id', $cupon->id)->whereNotNull('orden_id')->count(); ?>
											<p>Usos: {{$usos}}</p>
			                <form action="{{ url('/actualizar-cupon') }}" method="post">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="cupon_id" value="{{ $cupon->id }}">
												<input type="text" name="descripcion" class="form-control" value="{{ $cupon->descripcion }}" placeholder="Descripción" required>
												<input type="text" name="codigo" class="form-control" value="{{ $cupon->codigo }}" placeholder="Código" required>
												<input type="text" name="monto" class="form-control" value="{{ $cupon->monto }}" placeholder="Monto" required>
												<input type="number" name="usos" class="form-control" value="{{$cupon->usos}}" placeholder="Maximos usos" required>
												<input type="number" name="minimo" class="form-control" value="{{$cupon->minimo}}" placeholder="Monto minimo" required>
			        					<input class="form-control datepicker" type="text" placeholder="Fecha de expiración" value="{{$cupon->expiracion}}" name="expiracion" required>
												<select class="form-control" name="tipo" id="tipo{{ $cupon->id }}">
													<option value="">Tipo de clase</option>
													<option value="Deportiva">Deportiva</option>
													<option value="Cultural">Cultural</option>
													<option value="Evento">Evento</option>
													<option value="Residencial">Residencial</option>
												</select>
												<script type="text/javascript">
												 	if (document.getElementById('tipo{{ $cupon->id }}') != null) document.getElementById('tipo{{ $cupon->id }}').value = '{!! $cupon->tipo !!}';
												</script>
												<?php $usuarios=App\User::where('role', 'usuario')->orderBy('name', 'asc')->get(); ?>
												<select class="form-control" name="user_id" id="user{{ $cupon->id }}">
													<option value="">Usuario</option>
													@foreach ($usuarios as $usuario)
														<option value="{{$usuario->id}}">{{ucfirst($usuario->name)}} - {{$usuario->email}}</option>
													@endforeach
												</select>
												<script type="text/javascript">
												 	if (document.getElementById('user{{ $cupon->id }}') != null) document.getElementById('user{{ $cupon->id }}').value = '{!! $cupon->user_id !!}';
												</script>
												<input type="number" name="maximo" class="form-control" value="{{$cupon->maximo}}" placeholder="Uso maximo general" required>
												<p>&nbsp;</p>
												<p>&nbsp;</p>

			        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button>
			                </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->
		@endforeach
	@endif

	@if ($cupones)
		@foreach ($cupones as $cupon)
			<form style="display: none;" action="{{ url('/eliminar-cupon') }}" method="post">
				{!! csrf_field() !!}
				{{ method_field('DELETE') }}
				<input type="hidden" name="cupon_id" value="{{ $cupon->id }}">
				<input type="submit" id="botoneliminar{{ $cupon->id }}">
			</form>
		@endforeach
	@endif







@endsection
