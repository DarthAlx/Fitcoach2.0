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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">VENTAS</div>
				</div>

			</div>
			<p>&nbsp;</p><p>&nbsp;</p>
			<div class="row">

				<form action="{{url('ventas')}}" method="post">
					{!! csrf_field() !!}
					<div class="col-sm-offset-3 col-sm-3 col-md-2 col-md-offset-6">
							<input type="text" class="form-control datepicker" name="from" placeholder="Desde..." value="{{$from}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="text" class="form-control datepicker" name="to" placeholder="Hasta..." value="{{$to}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="submit" value="Ver periodo" class="btn btn-success">
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h1 class=" title pull-left">CLASES:  <span>{{count($ventas)}}</span></h1>
						@if ($ventas)
							<?php $sumatotal =0; $array=array(); ?>
							@foreach ($ventas as $venta)
							<?php

							
							$totales=App\Orden::where('folio', $venta->folio)->get();
							$grantotal=0;
							foreach ($totales as $total) {
								$grantotal=$grantotal+$total->cantidad;
							}
							
							if (in_array($venta->folio,$array)){
								}else{
							
							$descuento=App\Cuponera::where('orden_id', $venta->order_id)->first();

							if ($descuento){
								$sumatotal=$sumatotal + ($grantotal-$descuento->cupon->monto);
								
							}
							else{
								$sumatotal = $sumatotal + $grantotal;
							}
							$array[]=$venta->folio;
							

							}
							
								  ?>
							@endforeach
						@endif
						<h1 class=" title pull-right">TOTAL:  <span>${{$sumatotal}}</span></h1>
				</div>
			</div>

			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Ticket #</th>
						<th>Orden</th>
			      <th>Fecha de clase</th>
						<th>Orden creada</th>
			      <th>Cliente</th>
			      <th>Total</th>
						<th></th>
			  </tr>
			  </thead>
			  <tbody>

			  	<?php $array=array(); ?>

					@if ($ventas)
						@foreach ($ventas as $venta)
						<?php $descuento=App\Cuponera::where('orden_id', $venta->order_id)->first();  
								$totales=App\Orden::where('folio', $venta->folio)->get();
								$grantotal=0;
								foreach ($totales as $total) {
									$grantotal=$grantotal+$total->cantidad;
								}
						?>
						@if (in_array($venta->folio,$array))

									<!--clase ya mostrada, no se hace nada-->
								@else

						<tr style="cursor: pointer;">
									<td>{{$venta->folio}}</td>
						      <td>{{$venta->order_id}}</td>
						      <td>{{$venta->fecha}} {{$venta->hora}}</td>
									<td>{{$venta->created_at}}</td>
						      <td>{{$venta->user->name}}</td>
						      <td>@if($descuento){{$grantotal-$descuento->cupon->monto}}@else{{$grantotal}}@endif</td>
									<td><a href="{{url('/printinvoice')}}/{{$venta->order_id}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
						  </tr>

						  <?php $array[]=$venta->folio; ?>
						  @endif

						  
						
						@endforeach
					@else
						<tr style="cursor: pointer;">
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
					<th>Ticket #</th>
					<th>Orden</th>
					<th>Fecha de clase</th>
					<th>Orden creada</th>
					<th>Cliente</th>
					<th>Total</th>
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
