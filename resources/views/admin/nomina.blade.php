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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">NOMINA</div>
				</div>

			</div>
			<div class="row">

			</div>


			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Coach</th>
			      <th>Celular</th>
			      <th>Último pago</th>
			      <th>Pendiente</th>
			      <th>Referencias</th>
						<th>Acciones</th>
			  </tr>
			  </thead>
			  <tbody>


					@if ($coaches)
						@foreach ($coaches as $coach)
							<?php
								$pendiente=0;
								foreach ($coach->abonos as $abono) {
									$pendiente= $pendiente + $abono->abono;
								}

								$ultimo=App\Pago::where('user_id', $coach->id)->orderBy('created_at', 'desc')->first();
								if (!$ultimo) {
									$fecha ="No se han realizado pagos.";
								}
								else {
									$fecha=$ultimo->fecha;
								}
								$referencias=App\User::where('referencia',$coach->code.'-ganado')->count();
							?>
							<tr style="cursor: pointer;">
						      <td>



											{{$coach->name}} - {{$coach->detalles->rating}}


									</td>
						      <td>{{$coach->tel}}</td>
						      <td>{{$fecha}}</td>
						      <td>${{$pendiente}}</td>
						      <td>{{$referencias}}</td>
									<td>
										<button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#pagar{{$coach->id}}">Pagar</button>
										<button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#historial{{$coach->id}}">Historial</button>
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
					<th>Coach</th>
					<th>Celular</th>
					<th>Último pago</th>
					<th>Pendiente</th>
					<th>Referencias</th>
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

	@if ($coaches)
		@foreach ($coaches as $coach)
			<?php
				$ordenes= App\Reservacion::where('coach_id', $coach->id)->where('status', 'COMPLETO')->get();
				$pendiente=0;
				foreach ($coach->abonos as $abono) {
					$pendiente= $pendiente + $abono->abono;
				}


			?>
			<div class="modal fade" id="pagar{{$coach->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Pagar a {{Ucfirst($coach->name)}}</h4>
											@if ($coach->bancarios)
												<p style="list-group-item">
													<strong>Banco: </strong> {{ $coach->bancarios->banco}} <br>
													<strong>Cuenta: </strong> {{ $coach->bancarios->cta}} <br>
													<strong>CLABE: </strong> {{ $coach->bancarios->clabe}} <br>
													<strong>Tarjeta: </strong> {{ $coach->bancarios->tarjeta}} <br>
													<strong>Info. adicional: </strong> {{ $coach->bancarios->adicional}}
												</p>
											@else
												<p>No se han dado de alta detalles bancarios.</p>
											@endif

			                <form action="{{ url('/pagar') }}" method="post">
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="user_id" value="{{ $coach->id }}">
			        					<input class="form-control datepicker" type="text" placeholder="Fecha" name="fecha" required>
												<select class="form-control"  name="metodo" required>
													<option value="">Seleccionar método de pago</option>
													<option value="Transferencia">Transferencia</option>
													<option value="Asimilados">Asimilados</option>
													<option value="Efectivo">Efectivo</option>
												</select>
												<input type="text" name="referencia" class="form-control" value="" placeholder="Referencia" required>
												<input type="text" name="monto" class="form-control" value="{{$pendiente}}" placeholder="Monto" required>
												<input type="text" name="deducciones" class="form-control" placeholder="Deducciones" required>
												<input type="hidden" name="ordenes" class="form-control"  placeholder="Referencia" required>
			        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Pagar</button>
			                </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->
		@endforeach
	@endif

	@if ($coaches)
		@foreach ($coaches as $coach)
			<?php
				$pagos= App\Pago::where('user_id', $coach->id)->get();
			?>
			<div class="modal fade" id="historial{{$coach->id}}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

										<div id="historialpagos{{$coach->id}}">
											<h4>Historial de pagos de {{Ucfirst($coach->name)}}</h4>
											<table class="display table table-bordered table-striped table-hover" id="dynamic-table">
										  <thead>
										  <tr>
										      <th>Fecha</th>
										      <th>Método</th>
										      <th>Referencia</th>
										      <th>Balance</th>
										  </tr>
										  </thead>
										  <tbody>


												@if ($coach->pagos)
													@foreach ($coach->pagos as $pago)
														<tr style="cursor: pointer;">
													      <td>{{$pago->fecha}}</td>
													      <td>{{$pago->metodo}}</td>
													      <td>{{$pago->referencia}}</td>
													      <td>${{$pago->monto}}</td>
													  </tr>
													@endforeach
												@endif



										  </tbody>
										  <tfoot>
										  <tr>
												<th>Fecha</th>
												<th>Método</th>
												<th>Referencia</th>
												<th>Balance</th>
										  </tr>
										  </tfoot>
										  </table>
											<a href="{{url('historialpagos')}}/{{$coach->id}}"  class="btn btn-success" target="_blank" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Imprimir</a>
										</div>


						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->
		@endforeach
	@endif







@endsection
