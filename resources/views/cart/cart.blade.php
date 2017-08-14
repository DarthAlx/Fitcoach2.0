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
      @include('holders.notificaciones')
      <div class="cart-header">
        @if (Cart::content()->count()>0)
          <h1 class="title">{{Cart::content()->count()}} Clases <strong class="pull-right">${{Cart::total()}}</strong></h1>
          <div class="text-center">
            <i class="fa fa-chevron-down" aria-hidden="true" data-toggle="collapse" data-target="#carrito" aria-expanded="false" aria-controls="carrito"></i>
          </div>
        @else
          <h1 class="title">Tu carrito está vacio.</h1>
        @endif

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
                      @if ($product->options->tipo=="residencial")
                        <?php $residencial=App\Residencial::find($product->id); $esresidencial=true;?>
                      Dirección: {{$residencial->condominio->direccion}}
                    @else
                      <?php $esresidencial=false; ?>

                      @endif


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
    <p>&nbsp;</p>
    @if (Cart::content()->count()>0)
    <form action="{{url('cargo')}}" method="POST" id="card-form">
    <div class="col-sm-6">
      @if (!$esresidencial)
                        @if (!$user->direcciones->isEmpty())
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Dirección</label>
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
                          <div class="form-group"  id="identificadorNuevolabel">
                            <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('identificador') }}" id="identificadorNuevo"  name="identificadordireccion" placeholder="Ej: Casa, Condominio, Oficina ...">
                            </div>
                          </div>
                          <div class="form-group"  id="calleNuevolabel">
                            <label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
                            <div class="col-sm-9 col-md-5">
                              <input class="form-control" type="text" value="{{ old('calle') }}" id="calleNuevo"  name="calle">
                            </div>
                            <div class="col-sm-6 col-md-2">
                              <input class="form-control" type="text" value="{{ old('numero_ext') }}" id="numero_extNuevo"  name="numero_ext" placeholder="# Ext" >
                            </div>
                            <div class="col-sm-6 col-md-2">
                              <input class="form-control" type="text" value="{{ old('numero_int') }}" id="numero_intNuevo"  name="numero_int" placeholder="# Int">
                            </div>
                          </div>
                          <div class="form-group"  id="coloniaNuevolabel">
                            <label class="col-sm-3 control-label" for="card-number">Colonia</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('colonia') }}" id="coloniaNuevo"  name="colonia" >
                            </div>
                          </div>
                          <div class="form-group"  id="municipio_delNuevolabel">
                            <label class="col-sm-3 control-label" for="card-number">Municipio / Delegación</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('municipio_del') }}" id="municipio_delNuevo"  name="municipio_del" >
                            </div>
                          </div>
                          <div class="form-group"  id="cpNuevolabel">
                            <label class="col-sm-3 control-label" for="card-number">Código postal</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('cp') }}" id="cpNuevo"  name="cp" >
                            </div>
                          </div>
                          <div class="form-group"  id="estadoNuevolabel">
                            <label class="col-sm-3 control-label" for="card-number">Estado</label>
                            <div class="col-sm-9">
                              <select class="form-control"  name="estado" id="estadoNuevo" >
                                <option value="">Selecciona una opción</option>
                                <option value="CDMX">CDMX</option>
                                <option value="Edo. Méx">Edo. Méx</option>
                              </select>
                            </div>
                          </div>
                          <input type="hidden" name="esresidencial" value="false">
                        @else
                          <input type="hidden" name="esresidencial" value="true">
                        @endif <!--esresidencial-->

                          <input id="tokencsrf" type="hidden" name="_token" value="{{ csrf_token() }}">

    </div>
    <div class="col-sm-6">


        <div class="form-group" >
          <div class="col-xs-12 text-center">
            <i class="fa fa-cc-visa fa-2x">&nbsp;</i> <i class="fa fa-cc-mastercard fa-2x">&nbsp;</i> <i class="fa fa-cc-amex fa-2x">&nbsp;</i>
          </div>
          <p>&nbsp;</p>
        </div>
        @if (!$user->tarjetas->isEmpty())
          <div class="form-group">
            <label class="col-sm-3 control-label" for="card-number">Tarjeta</label>
            <div class="col-sm-9">
              <select class="form-control" id="tarjeta" name="tarjeta">
                <option value="">Nueva tarjeta</option>
                @foreach ($user->tarjetas as $tarjeta)
                  <option value="{{$tarjeta->id}}">{{$tarjeta->identificador}}</option>
                @endforeach
              </select>
            </div>
          </div>

        @endif
        <div class="form-group row" id="tarjeta1label">

            <div class="col-xs-12">

                <input class="form-control" id="numtarjeta"  name="numero" placeholder="Número de tarjeta" autocomplete="off"  data-conekta="card[number]" type="text" > </div>
        </div>
        <div class="form-group row">
          <div id="tarjeta2label">
            <div class="col-sm-5 col-xs-12">
                <input class="form-control" id="nombretitular"  name="nombre" placeholder="Nombre del titular" autocomplete="off" data-conekta="card[name]"  type="text" > </div>
            <div class="col-sm-2 col-xs-3">
                <input class="form-control" id="mm" placeholder="MM" name="mes" data-conekta="card[exp_month]" type="text" > </div>
            <div class="col-sm-2 col-xs-3">
                <input class="form-control" id="aa" placeholder="AA" name="año"  data-conekta="card[exp_year]" type="text" > </div>
          </div>
<label class="col-sm-3 control-label" for="card-number" id="cvvlabel" style="display:none;">Código de seguridad:</label>
            <div class="col-sm-3 col-xs-6">
                <div class="input-group">
                    <input class="form-control" id="cvv" placeholder="CVV" autocomplete="off"  data-conekta="card[cvc]" type="text" > <span class="input-group-btn"> <button type="button" class="form-control" data-toggle="popover" data-container="body" data-placement="top" data-content="Código de seguridad de 3 dígitos ubicado normalmente en la parte trasera de su tarjeta. Las tarjetas American Express tienen un código de 4 dígitos ubicado en el frente.">?</button> </span>
									</div>
            </div>
        </div>
				<div class="form-group row" id="tarjeta3label">
            <div class="col-xs-12">
							<div class="checkbox">
				        <label>
				          <input name="guardartarjeta" value="si" type="checkbox" id="guardartarjeta"> Guardar tarjeta
				        </label>
				      </div>
          </div>
        </div>
				<div class="form-group row" id="identificadorcont" style="display: none;">
					<div class="col-xs-12">
						<label>Identificador:</label>
					</div>
            <div class="col-xs-12">
							<input type="text" name="identificadortarjeta" class="form-control" placeholder="Ej: Crédito, Mi tarjeta, Banco ..." id="identificador">
          </div>
        </div>
				<input type="hidden" name="name" value="{{$user->name}}">
				<input type="hidden" name="email" value="{{$user->email}}">
				<input type="hidden" name="phone" value="{{$user->tel}}">


        <div class="form-group">
          <div class="col-sm-12 text-right">
            <button class="btn btn-success" type="submit"  id="botonguardarNuevo">Pagar</button>
          </div>
        </div>
    </div>
    </form>
@endif <!--carritovacio-->
    @if (!$user->direcciones->isEmpty())
      <script type="text/javascript">
        $('#direccion').change(function(){
          if ($('#direccion').val()!="") {

            $('#identificadorNuevo').prop( "disabled", true );
            $('#calleNuevo').prop( "disabled", true );
            $('#numero_extNuevo').prop( "disabled", true );
            $('#numero_intNuevo').prop( "disabled", true );
            $('#coloniaNuevo').prop( "disabled", true );
            $('#municipio_delNuevo').prop( "disabled", true );
            $('#cpNuevo').prop( "disabled", true );
            $('#estadoNuevo').prop( "disabled", true );
            $('#identificadorNuevolabel').hide();
            $('#calleNuevolabel').hide();
            $('#numero_extNuevolabel').hide();
            $('#numero_intNuevolabel').hide();
            $('#coloniaNuevolabel').hide();
            $('#municipio_delNuevolabel').hide();
            $('#cpNuevolabel').hide();
            $('#estadoNuevolabel').hide();

          }
          else{
            $('#identificadorNuevo').prop( "disabled", false );
            $('#calleNuevo').prop( "disabled", false );
            $('#numero_extNuevo').prop( "disabled", false );
            $('#numero_intNuevo').prop( "disabled", false );
            $('#coloniaNuevo').prop( "disabled", false );
            $('#municipio_delNuevo').prop( "disabled", false );
            $('#cpNuevo').prop( "disabled", false );
            $('#estadoNuevo').prop( "disabled", false );
            $('#identificadorNuevolabel').show();
            $('#calleNuevolabel').show();
            $('#numero_extNuevolabel').show();
            $('#numero_intNuevolabel').show();
            $('#coloniaNuevolabel').show();
            $('#municipio_delNuevolabel').show();
            $('#cpNuevolabel').show();
            $('#estadoNuevolabel').show();

          }
        });
      </script>
    @endif
    @if (!$user->tarjetas->isEmpty())
      <script type="text/javascript">
        $('#tarjeta').change(function(){
          if ($('#tarjeta').val()!="") {

          /*  $('#numtarjeta').prop( "disabled", true );
            $('#nombretitular').prop( "disabled", true );
            $('#mm').prop( "disabled", true );
            $('#aa').prop( "disabled", true );

            $('#guardartarjeta').prop( "disabled", true );*/

            $('#tarjeta1label').hide();
            $('#tarjeta2label').hide();
            $('#tarjeta3label').hide();
            $('#cvvlabel').show();
            tarjeta = $('#tarjeta').val();
            _token= $('#tokencsrf').val();
            $.post("http://localhost/Fitcoach2.0/cargartarjeta", {

            tarjeta : tarjeta,
            _token : _token
            }, function(data) {
               val = data.split(",");
               $('#numtarjeta').val(val[0]);
               $('#nombretitular').val(val[1]);
               $('#mm').val(val[2]);
               $('#aa').val(val[3]);
            });
          }
          else{
            /*$('#numtarjeta').prop( "disabled", false );
            $('#nombretitular').prop( "disabled", false );
            $('#mm').prop( "disabled", false );
            $('#aa').prop( "disabled", false );
            $('#cvv').prop( "disabled", false );
            $('#guardartarjeta').prop( "disabled", false );*/

            $('#tarjeta1label').show();
            $('#tarjeta2label').show();
            $('#tarjeta3label').show();
            $('#cvvlabel').hide();


          }
        });
      </script>

    @endif
    <script type="text/javascript">
    Conekta.setPublishableKey('key_ExsfYxwMz4KMdE5PTfN6B6g');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Inserta el token_id en la forma para que se envíe al servidor
    $form.append($('<input type="hidden" name="tokencard" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Hace submit
  };
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $("#cart-errors").show();
    $(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);
  };

  //jQuery para que genere el token después de dar click en submit
  $(function () {
    $("#card-form").submit(function(event) {

      var $form = $(this);
      // Previene hacer submit más de una vez
      $form.find("button").prop("disabled", true);
      Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
    $("#guardartarjeta").click( function(){
           if( $(this).is(':checked') ){
             $('#identificadorcont').show();
             $("#identificador").attr("", true);
           }
           else {
            $('#identificadorcont').hide();
            $("#identificador").attr("", false);
           }
        });
    </script>
  @endif


  </div>
</section>
@endsection
