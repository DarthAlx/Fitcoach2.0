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
				<?php
				$month = date('m');
	      $year = date('Y');
	      $from = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
	      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
	      $to=date('Y-m-d', mktime(0,0,0, $month, $day, $year));
				?>
				<form action="{{url('ventas')}}" method="post">
					{!! csrf_field() !!}
					<div class="col-sm-offset-3 col-sm-3 col-md-2 col-md-offset-6">
							<input type="text" class="form-control datepicker" name="from" placeholder="Desde..." value="{{$from}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="text" class="form-control datepicker" name="to" placeholder="Hasta..." value="{{$to}}">
					</div>
					<div class="col-sm-3 col-md-2">
							<input type="submit" value="Enviar" class="btn btn-success">
					</div>
				</form>
			</div>
			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Ticket #</th>
			      <th>Fecha</th>
			      <th>Cliente</th>
			      <th>Total</th>
						<th></th>
			  </tr>
			  </thead>
			  <tbody>

					@if ($ventas)
						@foreach ($ventas as $venta)
							<tr style="cursor: pointer;">
						      <td>{{$venta->order_id}}</td>
						      <td>{{$venta->fecha}}</td>
						      <td>{{$venta->user->name}}</td>
						      <td>{{$venta->cantidad}}</td>
									<td></td>
						  </tr>
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
					<th>Ticket</th>
					<th>Fecha</th>
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
