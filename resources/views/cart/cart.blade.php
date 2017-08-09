@extends('plantilla')
@section('pagecontent')
<section class="container-bootstrap">
  <div class="topclear">
	    &nbsp;
	  </div>
  <div class="modal-body row">
    @if (Auth::guest())
      <div class="col-sm-12">
          <h1 class="gotham2 text-center">Inicia sesión o registrate con nosotros! <br><br><br> <button type="button" data-toggle="modal" data-target="#loginmodal" class="btn btn-success" style="width: 65%; margin: 0 auto;">Comienza ya!</button></h1>
      </div>
    @else
      <?php $user=App\User::find(Auth::user()->id); ?>
    <div class="col-sm-12">
      <div class="cart-header">
        <h1 class="title">{{Cart::content()->count()}} Clases <strong class="pull-right">${{Cart::total()}}</strong></h1>
        <div class="text-center">
          <i class="fa fa-chevron-down" aria-hidden="true" data-toggle="collapse" data-target="#carrito" aria-expanded="false" aria-controls="carrito"></i>
        </div>
      </div>

      <div class="collapse" id="carrito">
        <div class="">
          <div class="panel-body">

							@foreach ($items as $product)
							<div class="row">

								<div class="col-xs-4">
									<h4 class="product-name"><strong>{{ $product->name }}</strong></h4>

										<h4><small>
											Fecha: {{ $product->options->fecha }}<br>

											Horario: {{ $product->options->hora }}<br>
											<?php $coach=App\User::find($product->options->coach); ?>
											Coach: {{ $coach->name }}<br>

										</small></h4>


								</div>
								<div class="col-xs-8">
									<div class="col-xs-10 text-right gotham2">
										<h6><strong>${{ $product->price}} <span class="text-muted"></span></strong></h6>
									</div>

									<div class="col-xs-2">
										<a href="{{url('removefromcart')}}/{{$product->rowId}}" class="btn btn-link btn-xs">
											<i class="fa fa-trash fa-lg" aria-hidden="true"></i> </span>
										</a>
									</div>
								</div>

							</div>
							<hr>
							@endforeach
							<hr>

						</div>
        </div>
      </div>



    </div>
    <div class="col-sm-6">
      <form action="{{ url('/agregar-direccion') }}" method="post">
                        @if ($user->direcciones)
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Guardadas</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="direccion" name="direccion">
                                <option value="">Nueva dirección</option>
                                @foreach ($user->direcciones as $direccion)
                                  <option value="{{$direccion->id}}">{{$direccion->identificador}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                        @endif
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('identificador') }}" id="identificadorNuevo"  name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
                            <div class="col-sm-5">
                              <input class="form-control" type="text" value="{{ old('calle') }}" id="calleNuevo"  name="calle" required>
                            </div>
                            <div class="col-sm-2">
                              <input class="form-control" type="text" value="{{ old('numero_ext') }}" id="numero_extNuevo"  name="numero_ext" placeholder="# Ext" required>
                            </div>
                            <div class="col-sm-2">
                              <input class="form-control" type="text" value="{{ old('numero_int') }}" id="numero_intNuevo"  name="numero_int" placeholder="# Int">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Colonia</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('colonia') }}" id="coloniaNuevo"  name="colonia" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Municipio / Delegación</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('municipio_del') }}" id="municipio_delNuevo"  name="municipio_del" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Código postal</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('cp') }}" id="cpNuevo"  name="cp" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Estado</label>
                            <div class="col-sm-9">
                              <select class="form-control"  name="estado" id="estadoNuevo" required>
                                <option value="">Selecciona una opción</option>
                                <option value="CDMX">CDMX</option>
                                <option value="Edo. Méx">Edo. Méx</option>
                              </select>
                            </div>
                          </div>
                          {!! csrf_field() !!}

                          <div class="form-group">
                            <div class="col-sm-12 text-right">
                              <input class="btn btn-success" type="submit" value="Guardar" id="botonguardarNuevo">
                            </div>
                          </div>

                    </form>
                    @if ($user->direcciones)
                      <script type="text/javascript">
                        $('#direccion').change(function(){
                          if ($('#direccion').val()!="") {
                            <?php $direccion=App\Direccion::find( ?>$('#direccion').val()<?php ); ?>
                            {{dd($direccion)}}
                            $('#identificadorNuevo').prop( "disabled", true );
                            $('#calleNuevo').prop( "disabled", true );
                            $('#numero_extNuevo').prop( "disabled", true );
                            $('#numero_intNuevo').prop( "disabled", true );
                            $('#coloniaNuevo').prop( "disabled", true );
                            $('#municipio_delNuevo').prop( "disabled", true );
                            $('#cpNuevo').prop( "disabled", true );
                            $('#estadoNuevo').prop( "disabled", true );
                            $('#botonguardarNuevo').hide();
                          }
                        });
                      </script>

                    @endif
    </div>
    <div class="col-sm-6">

    </div>
    @endif
  </div>
</section>
@endsection
