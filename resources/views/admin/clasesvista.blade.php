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
					<div class="title" style="font-size: 10vw;">CLASES</div>
				</div>

			</div>
			<div class="row">

				<form action="{{url('clasesvista')}}" method="post">
					{!! csrf_field() !!}
					<div class=" col-sm-3 col-md-2 col-md-offset-4">
						<select class="form-control" name="status" id="status">
							<option value="*">Todas</option>
							<option value="Proxima">Proxima</option>
							<option value="Cancelada">Cancelada</option>
							<option value="porrevisar">Por revisar</option>
							<option value="Completa">Completada</option>
							<option value="abonada">Abonada</option>
						</select>
						<script type="text/javascript">
							document.getElementById('status').value='{!!$status!!}';
						</script>
					</div>
					<div class="col-sm-3 col-md-2">
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
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Folio #</th>
			      <th>Clase</th>
			      <th>Coach</th>
			      <th>Status</th>
			  </tr>
			  </thead>
			  <tbody>

					@if ($clases)
						@foreach ($clases as $clase)
							<tr style="cursor: pointer;">
						      <td>{{$clase->folio}}</td>
						      <td>{{$clase->nombre}}</td>
						      <td>{{$clase->user->name}}</td>
						      <td>{{$clase->status}}</td>
						  </tr>
						@endforeach
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					<th>Folio #</th>
					<th>Clase</th>
					<th>Coach</th>
					<th>Status</th>
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
