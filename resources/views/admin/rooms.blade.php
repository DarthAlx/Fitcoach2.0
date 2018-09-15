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
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">ROOMS</div>
				</div>

			</div>
			<p>&nbsp;</p><p>&nbsp;</p>
			<div class="row">
				<button type="button" name="button" class="btn btn-default" data-toggle="modal" data-target="#nuevo">Agregar room</button>

			</div>


			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			      <th>Nombre</th>
			      <th>Descripción</th>
						<th>Imágen</th>
						<th></th>
			  </tr>
			  </thead>
			  <tbody>


					@if ($rooms)
						@foreach ($rooms as $room)
							<tr style="cursor: pointer;">
						      <td>{{$room->nombre}}</td>
						      <td>{{$room->descripcion}}</td>
									<td><img src="{{url('uploads/rooms')}}/{{$room->imagen}}" style="max-width: 80px;"></td>
									<td>
										<button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#room{{$room->id}}">Editar</button>
										<a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $room->id }}').click();">Borrar</a>
									</td>
						  </tr>
						@endforeach
					@else
						<tr style="cursor: pointer;">
								<td></td>
								<td></td>
								<td></td>
								<th></th>
						</tr>
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
						<th>Nombre</th>
			      <th>Descripción</th>
						<th>Imágen</th>
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



	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-body">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

								<div>
									<h4>Agregar room</h4>
									<form action="{{ url('/agregar-room') }}" method="post" enctype="multipart/form-data">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">

										<input type="text" name="nombre" class="form-control"  placeholder="Nombre" required>

										<textarea name="descripcion" class="form-control" placeholder="Descripción" required>{{ old('descripcion') }}</textarea>
										
											<label class="col-sm-3 control-label">Imágen </label>
											
												<input class="form-control" type="file"  name="imagen" required>
											
	
										<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Crear</button>
									</form>
								</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal pago-->




	@if ($rooms)
		@foreach ($rooms as $room)
			<div class="modal fade" id="room{{$room->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Editar room</h4>

			                <form action="{{ url('/actualizar-room') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="room_id" value="{{ $room->id }}">
												<input type="text" name="nombre" class="form-control" value="{{ $room->nombre }}" placeholder="Nombre" required>

												<input type="text" name="descripcion" class="form-control" value="{{ $room->descripcion }}" placeholder="Descripción">
												<label class="col-sm-3 control-label">Imagen (solo si se desea reemplazar)</label>
											
												<input class="form-control" type="file"  name="imagen">

			        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Actualizar</button>
			                </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal pago-->
		@endforeach
	@endif

	@if ($rooms)
		@foreach ($rooms as $room)
			<form style="display: none;" action="{{ url('/eliminar-room') }}" method="post">
				{!! csrf_field() !!}
				{{ method_field('DELETE') }}
				<input type="hidden" name="room_id" value="{{ $room->id }}">
				<input type="submit" id="botoneliminar{{ $room->id }}">
			</form>
		@endforeach
	@endif







@endsection
