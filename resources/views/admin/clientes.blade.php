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
						<th>Fecha de creación</th>
						<th># Compradas</th>
						<th></th>
			  </tr>
			  </thead>
			  <tbody>


					@if ($usuarios)
						@foreach ($usuarios as $usuario)
							<tr>
						      <td>{{$usuario->name}}</td>
						      <td>{{$usuario->email}}</td>
						      <td>{{$usuario->tel}}</td>
						      <td>{{$usuario->dob}}</td>
									<td>{{$usuario->genero}}</td>
									<td>{{$usuario->created_at}}</td>
									<td  style="cursor: pointer;" data-toggle="modal" data-target="#compras{{$usuario->id}}">{{$usuario->ordenes->count()}}</td>
									<td><a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $usuario->id }}').click();">Borrar</a>
										<form style="display: none;" action="{{ url('/eliminar-cliente') }}" method="post">
								{!! csrf_field() !!}
								{{ method_field('DELETE') }}
								<input type="hidden" name="user_id" value="{{ $usuario->id }}">
								<input type="submit" id="botoneliminar{{ $usuario->id }}">
							</form>
							<a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#tokenplus{{$usuario->id}}"><i class="fa fa-plus"></i></a>
							<a href="#" class="btn btn-info"  data-toggle="modal" data-target="#tokenminus{{$usuario->id}}"><i class="fa fa-minus"></i></a>
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
								<th></th>
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
					<th>Fecha de creación</th>
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
@if ($usuarios)
	@foreach ($usuarios as $usuario)
		<div class="modal fade" id="compras{{$usuario->id}}" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">

		      <div class="modal-body">

		              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

		      				<div>
		      					@if(!$usuario->paquetes->isEmpty())
										<h4>Historial de compras</h4>
										<?php
										$user=$usuario;
										$particulares=App\PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->where('disponibles','<>',0)->orderBy('expiracion','asc')->get();
										$residenciales=App\PaqueteComprado::where('user_id', $user->id)->where('tipo','En condominio')->where('disponibles','<>',0)->orderBy('expiracion','asc')->get();
										$partdisp=0;
										$resdisp=0; 
										$partexp=0;
										$resexp=0;      
										$today = strtotime(date('Y-m-d'));

										foreach ($particulares as $pd) {

										$expire = strtotime($pd->expiracion);
											if ($expire >= $today) {
												$partdisp=$partdisp+$pd->disponibles;
											}
											else{
												$partexp=$partexp+$pd->disponibles;
											}
										}

										foreach ($residenciales as $rd) {

										$expire = strtotime($rd->expiracion);
											if ($expire >= $today) {
												$resdisp=$resdisp+$rd->disponibles;
											}
											else{
												$resexp=$resexp+$rd->disponibles;
											}
										}
										?>
		      					<div class="table-responsive">
		      						<table class="table">
		      							<thead>
		      								<tr>
		      									<th>Paquete</th>
			      								<th>Tipo</th>
			      								<th>Fecha</th>
														<th>Expiración</th>
			      								<th>Pagado</th>
		      								</tr>
		      							</thead>
		      							<tbody>
		      								
			      								@foreach($usuario->paquetes as $paquete)
				      								<tr>
				      									<td>{{$paquete->clases}} Clases</td>
				      									<td>{{$paquete->tipo}}</td>
				      									<td>{{$paquete->fecha}}</td>
																<td>{{$paquete->expiracion}}</td>
				      									<td>${{$paquete->orden->cantidad-$paquete->orden->descuento}} MXN</td>
				      								</tr>
			      								@endforeach
		      								
		      							</tbody>
		      						</table>
		      					</div>
		      					@else
		      					<h4>Aún no hay compras</h4>
		      					@endif
		                		
		      				</div>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal detalles user -->







		<div class="modal fade" id="tokenplus{{$usuario->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Añadir token a {{$usuario->name}}</h4>
											

			                <form action="{{ url('/tokenplus') }}" method="post">
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="user_id" value="{{ $usuario->id }}">
												<select class="form-control"  name="tipo" required>
													<option value="">Seleccionar tipo de clase</option>
													<option value="A domicilio">A domicilio</option>
													<option value="En condominio">En condominio</option>
												</select>
												<input type="number" name="tokens" class="form-control" value="" placeholder="Tokens" required>
												
			        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Añadir</button>
			                </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->


			<div class="modal fade" id="tokenminus{{$usuario->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Quitar token a {{$usuario->name}}</h4>
											

			                <form action="{{ url('/tokenminus') }}" method="post">
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="user_id" value="{{ $usuario->id }}">
												<select class="form-control"  name="tipo" required>
													<option value="">Seleccionar tipo de clase</option>
													<option value="A domicilio">A domicilio</option>
													<option value="En condominio">En condominio</option>
												</select>
												<input type="number" name="tokens" class="form-control" value="" placeholder="Tokens" required>
												
			        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Quitar</button>
			                </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->




	@endforeach
@endif



@endsection
