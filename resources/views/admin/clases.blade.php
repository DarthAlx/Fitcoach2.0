@extends('plantilla')

@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="">
		<div class="container-bootstrap-fluid">



			<div class="row">
				<div class="col-sm-12">
        	@include('holders.notificaciones')
      	</div>
				<div class="col-sm-12">
					<div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">CLASES</div>
					<!--div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
					  <div class="footerSubscribe">
					    <form action="{{url('coaches')}}" method="post">
					      {!! csrf_field() !!}
					      <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
					      <button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
					    </form>
					  </div>

					</div-->
				</div>
				<!--div class="col-sm-3 visible-xs">
					<div class="buscador">
						<div class="footerSubscribe">
			  			<form action="{{url('coaches')}}" method="post">
								{!! csrf_field() !!}
			  				<input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
								<button class="btnSubscribe" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			  			</form>
			  		</div>

					</div>
				</div-->
			</div>
		












<p>&nbsp;</p>
<div class="row">
				<div class="col-sm-12 text-right">
        	<a href="#" class="btn btn-success btn-lg hidden-xs" style="max-width: 200px;" data-toggle="modal" data-target="#nuevaclase">Agregar Clase</a>
        	<a href="#" class="btn btn-success btn-lg visible-xs" data-toggle="modal" data-target="#nuevaclase">Agregar Clase</a>
      	</div>
</div>
<p>&nbsp;</p>
 

			<div class="row">
				<div class="adv-table table-responsive">
			  <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
			  <thead>
			  <tr>
			<th>Nombre</th>
						<th><i class="fa fa-picture-o"></i></th>

			      
			      <th>Tipo</th>



			  </tr>
			  </thead>
			  <tbody>
					@if ($clases)
						@foreach ($clases as $clase)

									<tr style="cursor: pointer;"  data-toggle="modal" data-target="#clase{{$clase->id}}">

								    <td>{{ucfirst($clase->nombre)}}</td>
											<td>
												 <img src="{{ url('uploads/clases') }}/{{$clase->imagen}}" class="img-responsive" style="max-width: 50px;">
											</td>

								      
								      		<td>{{$clase->tipo}}</td>		      
								      
											</tr>
									
								


						@endforeach
					@endif



			  </tbody>
			  <tfoot>
			  <tr>
					<th>Nombre</th>
						<th><i class="fa fa-picture-o"></i></th>

			      
			      <th>Tipo</th>


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
	<div class="modal fade" id="nuevaclase" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">

	      <div class="modal-body">

	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

	      				<div>
	      					<h4>Agregar clase</h4>
	                <form action="{{ url('/agregar-clase') }}" method="post" enctype="multipart/form-data">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input id="nombreNuevo" class="form-control" type="text" value="{{ old('nombre') }}" placeholder="Nombre" name="nombre" required>
										<select class="form-control"  name="tipo" id="tipoNuevo" required>
	                     <option value="">Selecciona un tipo</option>
	                       <option value="Deportiva">Deportiva</option>
	                       <option value="Kids">Kids</option>
	                       <option value="Cultural">Cultural</option>
	                   </select>
										<input class="form-control" id="imagenNuevo" type="file" name="imagen" required>
										<textarea id="precioNuevo" class="form-control" name="descripcion" placeholder="Descripcion" required>{{ old('descripcion') }}</textarea>
										
	        					<button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">Guardar</button>
	                </form>
	      				</div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal detalles user -->

	@if ($clases)
		@foreach ($clases as $clase)
			<div class="modal fade" id="clase{{$clase->id}}" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">

			      <div class="modal-body">

			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{url('/images/cross.svg')}}" alt=""></button>

			      				<div>
			      					<h4>Actualizar clase</h4>
			                <form action="{{ url('/actualizar-clase') }}" method="post" enctype="multipart/form-data">
												{{ method_field('PUT') }}
			        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input id="nombre{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->nombre }}" name="nombre" required>
												<select class="form-control"  name="tipo" id="tipo{{ $clase->id }}" required>
	                         	<option value="">Selecciona una opción</option>
	                           <option value="Deportiva">Deportiva</option>
	                           <option value="Kids">Kids</option>
	                           <option value="Cultural">Cultural</option>
	                      </select>
				 		 						<script type="text/javascript">
                         if (document.getElementById('tipo{{ $clase->id }}') != null) document.getElementById('tipo{{ $clase->id }}').value = '{!! $clase->tipo !!}';
                       	</script>
												<input class="form-control" type="file" id="imagen{{ $clase->id }}" name="imagen">
												<textarea id="descripcion{{ $clase->id }}" class="form-control" name="descripcion" required>{{ $clase->descripcion }}</textarea>
												
												<input type="hidden" name="clase_id" value="{{ $clase->id }}">
												<div class="text-center">
                          <button  class="btn btn-success" type="submit" style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">Actualizar</button>
                          <a href="#" class="btn btn-success" style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;" onclick="javascript: document.getElementById('botoneliminar{{ $clase->id }}').click();">Borrar</a>
                        </div>
			                </form>
											<form style="display: none;" action="{{ url('/eliminar-clase') }}" method="post">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="clase_id" value="{{ $clase->id }}">
                        <input type="submit" id="botoneliminar{{ $clase->id }}">
                      </form>
			      				</div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal detalles user -->
		@endforeach
	@endif

@endsection
