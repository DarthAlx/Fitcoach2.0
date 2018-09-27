@extends('plantilla')
@section('pagecontent')
    <section class="container-bootstrap">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="modal-body row">
            @if (Auth::guest())
                <div class="col-sm-12">
                    <h1 class="gotham2 text-center" style="padding: 15vh 0;">¡Inicia sesión o registrate con nosotros!
                        <br><br><br>
                        <button type="button" data-toggle="modal" data-target="#loginmodal" class="btn btn-success"
                                style="width: 65%; margin: 0 auto;">Entrar
                        </button>
                    </h1>
                </div>
            @else
                <?php $user = App\User::find(Auth::user()->id);
                $esresidencial = true;?>

                <div class="col-sm-12">
                    @include('holders.notificaciones')
                    <div class="cart-header">
                        @if (Cart::content()->count()>0)
                            @foreach ($items as $product)
                                @if ($product->id=="Desc")
                                    <?php $descuento = $product; $tienedescuento = true; break; ?>
                                @else
                                    <?php $tienedescuento = false; ?>
                                @endif
                            @endforeach

                            <h1 class="title text-center">
                                VAS A RESERVAR <span style="color: #D58628; font-weight: bold">{{Cart::content()->count()}}
                                    CLASES</span></h1>
                            <div class="text-center">
                                <i class="fa fa-chevron-down" aria-hidden="true" data-toggle="collapse"
                                   data-target="#carrito" aria-expanded="false" aria-controls="carrito"></i>
                            </div>
                        @else
                            <h1 class="title">Tu carrito está vacio.</h1>
                        @endif

                    </div>

                    <div class="collapse" id="carrito">
                        <div class="">
                            <div class="panel-body">

                                @foreach ($items as $product)
                                    @if ($product->id!="Desc")
                                        <div class="row">

                                            <div class="col-xs-4">
                                                <h4 class="product-name"><strong>{{ $product->name }}</strong></h4>

                                                <h4>
                                                    <small>
                                                        Fecha: {{ $product->options->fecha }}<br>
                                                        Horario: {{ $product->options->hora }}<br>
                                                        @if(isset($product->options->coach))
                                                            <?php $coach = App\User::find($product->options->coach); ?>
                                                            COACH: {{ $coach->name }}<br>
                                                        @endif
                                                        @if ($product->options->tipo=="residencial")
                                                            <?php $residencial = App\Horario::find($product->id); $esresidencial = true;?>
                                                            Dirección: {{$residencial->grupo->condominio->direccion}}
                                                        @elseif($product->options->tipo=="evento")
                                                            Dirección: {!!$product->direccion!!}
                                                        @else
                                                            <?php $esresidencial = false; ?>
                                                        @endif
                                                    </small>
                                                </h4>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="col-xs-10 text-right gotham2">

                                                </div>
                                                <div class="col-xs-2">
                                                    <a href="{{url('removefromcart')}}/{{$product->rowId}}"
                                                       class="btn btn-link btn-xs">
                                                        <i class="fa fa-trash fa-lg" aria-hidden="true"></i> </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <hr>

                                @endforeach
                                @if (Cart::content()->count()>0)
                                    @if ($tienedescuento)
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <h4 class="product-name"><strong>{{ $descuento->name }}</strong></h4>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="col-xs-10 text-right gotham2">
                                                    <h6><strong>{{ $descuento->price}} <span class="text-muted"></span></strong>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <hr>

                            </div>
                        </div>
                    </div>


                </div>
                <p>&nbsp;</p>
                @if (Cart::content()->count()>0)
                    <div class="row">
                        <div class="col-sm-6">
                            @if (!$esresidencial)
                                @if (!$user->direcciones->isEmpty())

                                    <h1 class="title" style="margin-top: 0px; line-height: 0.8;">
                                        Dirección
                                    </h1>
                                @endif
                            @endif
                        </div>

                    </div>
                @endif
                <p>&nbsp;</p>
                @if (Cart::content()->count()>0)
                    <form action="{{url('reservar')}}" method="POST" id="card-form">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                @if (!$esresidencial)
                                    @if (!$user->direcciones->isEmpty())
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label" for="card-number">Direcciónes
                                                guardadas</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="direccion" name="direccion">
                                                    <option value="">Agregar dirección</option>
                                                    @foreach ($user->direcciones as $direccion)
                                                        <option value="{{$direccion->id}}">{{$direccion->identificador}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @endif
                                    <div class="form-group row" id="identificadorNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                   value="{{ old('identificadordireccion') }}"
                                                   id="identificadordireccion" name="identificadordireccion"
                                                   placeholder="Ej: Casa, Condominio, Oficina ..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="calleNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
                                        <div class="col-sm-9 col-md-5">
                                            <input class="form-control" type="text" value="{{ old('calle') }}"
                                                   id="calle" name="calle" required>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input class="form-control" type="text" value="{{ old('numero_ext') }}"
                                                   id="numero_ext" name="numero_ext" placeholder="# Ext" required>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input class="form-control" type="text" value="{{ old('numero_int') }}"
                                                   id="numero_int" name="numero_int" placeholder="# Int" required>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="coloniaNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-number">Colonia</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" value="{{ old('colonia') }}"
                                                   id="colonia" name="colonia" required>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="municipio_delNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-number">Municipio / Del</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" value="{{ old('municipio_del') }}"
                                                   id="municipio_del" name="municipio_del" required>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="cpNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-number">Código postal</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" value="{{ old('cp') }}" id="cp"
                                                   name="cp" required>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="estadoNuevolabel">
                                        <label class="col-sm-3 control-label" for="card-number">Estado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" value="{{old('estado')}}" name="estado"
                                                    id="estado" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="CDMX">CDMX</option>
                                                <option value="Edo. Méx">Edo. Méx</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <button class="btn btn-success" type="submit" id="botonguardarNuevo">
                                                Reservar
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="esresidencial" value="false">
                                @else
                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <button class="btn btn-success" type="submit" id="botonguardarNuevo2">
                                                Reservar
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="esresidencial" value="true">
                            @endif <!--esresidencial-->

                                <input id="tokencsrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div id="postdireccion">

                                </div>
                                <script type="text/javascript">
                                    function postDireccion() {
                                        postdireccion = $('#direccion').val();
                                        _token = $('#tokencsrf').val();
                                        $.post("{{url('/traerdireccion')}}", {
                                            postdireccion: postdireccion,
                                            _token: _token
                                        }, function (data) {
                                            document.getElementById('postdireccion').innerHTML = data;
                                        });
                                    }

                                    $("#direccion").change(function () {
                                        postDireccion();
                                    });
                                </script>

                            </div>

                        </div>

                    </form>
                    <script>
                        $('#card-form').on('submit', function () {
                            $('#botonguardarNuevo').addClass('disabled');
                            $('#botonguardarNuevo2').addClass('disabled');
                        });
                    </script>
                @endif <!--carritovacio-->
                @if (!$user->direcciones->isEmpty())
                    <script type="text/javascript">
                        $('#direccion').change(function () {
                            if ($('#direccion').val() != "") {
                                $('#identificadordireccion').prop("disabled", true);
                                $('#calle').prop("disabled", true);
                                $('#numero_ext').prop("disabled", true);
                                $('#numero_int').prop("disabled", true);
                                $('#colonia').prop("disabled", true);
                                $('#municipio_del').prop("disabled", true);
                                $('#cp').prop("disabled", true);
                                $('#estado').prop("disabled", true);
                                $('#identificadorNuevolabel').hide();
                                $('#calleNuevolabel').hide();
                                $('#numero_extNuevolabel').hide();
                                $('#numero_intNuevolabel').hide();
                                $('#coloniaNuevolabel').hide();
                                $('#municipio_delNuevolabel').hide();
                                $('#cpNuevolabel').hide();
                                $('#estadoNuevolabel').hide();
                                $('#identificadordireccion').prop("required", false);
                                $('#calle').prop("required", false);
                                $('#numero_ex').prop("required", false);
                                $('#numero_int').prop("required", false);
                                $('#colonia').prop("required", false);
                                $('#municipio_del').prop("required", false);
                                $('#cp').prop("required", false);
                                $('#estado').prop("required", false);
                            }
                            else {
                                $('#identificadordireccion').prop("disabled", false);
                                $('#calle').prop("disabled", false);
                                $('#numero_ext').prop("disabled", false);
                                $('#numero_int').prop("disabled", false);
                                $('#colonia').prop("disabled", false);
                                $('#municipio_del').prop("disabled", false);
                                $('#cp').prop("disabled", false);
                                $('#estado').prop("disabled", false);
                                $('#identificadorNuevolabel').show();
                                $('#calleNuevolabel').show();
                                $('#numero_extNuevolabel').show();
                                $('#numero_intNuevolabel').show();
                                $('#coloniaNuevolabel').show();
                                $('#municipio_delNuevolabel').show();
                                $('#cpNuevolabel').show();
                                $('#estadoNuevolabel').show();
                                $('#identificadordireccion').prop("required", true);
                                $('#calle').prop("required", true);
                                $('#numero_ext').prop("required", true);
                                $('#numero_int').prop("required", true);
                                $('#colonia').prop("required", true);
                                $('#municipio_del').prop("required", true);
                                $('#cp').prop("required", true);
                                $('#estado').prop("required", true);


                            }
                        });
                    </script>
                @endif
                @if (!$user->tarjetas->isEmpty())
                    <script type="text/javascript">
                        $('#tarjeta').change(function () {
                            if ($('#tarjeta').val() != "") {
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
                                _token = $('#tokencsrf').val();
                                $.post("{{url('/')}}/cargartarjeta", {
                                    tarjeta: tarjeta,
                                    _token: _token
                                }, function (data) {
                                    val = data.split(",");
                                    $('#numtarjeta').val(val[0]);
                                    $('#nombretitular').val(val[1]);
                                    $('#mm').val(val[2]);
                                    $('#aa').val(val[3]);
                                });
                            }
                            else {
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
                    Conekta.setPublishableKey('key_UzGAymZCxzCcaMTrBo8bhLA');
                    var conektaSuccessResponseHandler = function (token) {
                        var $form = $("#card-form");
                        //Inserta el token_id en la forma para que se envíe al servidor
                        $form.append($('<input type="hidden" name="tokencard" id="conektaTokenId">').val(token.id));
                        $form.get(0).submit(); //Hace submit
                    };
                    var conektaErrorResponseHandler = function (response) {
                        var $form = $("#card-form");
                        $("#cart-errors").show();
                        $(".card-errors").text(response.message_to_purchaser);
                        $form.find("button").prop("disabled", false);
                    };
                    //jQuery para que genere el token después de dar click en submit
                    $(function () {
                        $("#card-form").submit(function (event) {
                            fbq('track', 'InitiateCheckout');
                            var $form = $(this);
                            // Previene hacer submit más de una vez
                            $form.find("button").prop("disabled", true);
                            Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                            return false;
                        });
                    });
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover();
                    });
                    $("#guardartarjeta").click(function () {
                        if ($(this).is(':checked')) {
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