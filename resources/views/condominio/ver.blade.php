@extends('plantilla')
@section('pagecontent')
    <section class="container">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="">
            <div class="container-bootstrap-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 style="margin-top: 0">Bienvenido a <span class="nombre">{{$condominio->identificador}}</span></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ver-clases">
                            <button class="btn btn-success btn-block " data-toggle="modal"
                                    data-target="#calendario{{$condominio->id}}">
                                Ver todas las clases
                            </button>
                        </div>
                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-xs-6" style="padding: 0 !important;">
                                    <a data-toggle="modal" data-target="#calendario-room{{$room->id}}">
                                        <img src="{{ url('uploads/rooms') }}/{{ $room->imagen }}"
                                             class="img-responsive">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                        <h3>CLASES DE HOY</h3>
                        @foreach($horarios as $horario)
                            @foreach($horario->reservaciones as $reservacion)
                                <div class="row condominios-clases">
                                    <div class="col-lg-2 col-xs-4">
                                        <b class="condominios-clases-text">{{$horario->clase->nombre}}</b>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <p class="condominios-clases-text"> {{$horario->user->name}}</p>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <p class="condominios-clases-text">{{$horario->grupo->room->nombre}}</p>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <p class="condominios-clases-text">{{$horario->hora}}</p>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <p class="condominios-clases-text">
                                            @if(isset($horario->tokens) && $horario->tokens>0)
                                                <span>Con costo</span>
                                            @else
                                                <span>Incluida</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        @if($hour>$horario->hora)
                                            <button class="btn" style="background-color: #999; color:#fff;border-radius: 40px;display: block;margin: auto">
                                                Impartida
                                            </button>
                                        @elseif($reservacion->status!='PROXIMA')
                                            <button class="btn" style="background-color: #999; color:#fff;border-radius: 40px;display: block;margin: auto"">
                                                No disponible
                                            </button>
                                        @else
                                            {!! Form::open(['url' => 'carrito']) !!}
                                            <input type="hidden" name="cantidad" value="1">
                                            <input type="hidden"
                                                   name="carrito[]"
                                                   value="{{$horario->id}},{{$date}},{{$horario->tokens}}">
                                            <input type="hidden"
                                                   name="tipo"
                                                   value="En condominio">
                                            <button class="btn btn-success" type="submit">
                                                Reservar
                                            </button>
                                            {!! Form::close() !!}

                                        @endif
                                    </div>
                                </div>

                            @endforeach
                        @endforeach
                        <div class="row condominios-clases">
                            <div class="col-lg-12">
                                <p style="text-align: center">No hay más clases disponibles hoy</p>
                            </div>
                        </div>
                        <h3>PRÓXIMOS EVENTOS</h3>
                        <div class="row">
                            @if(count($eventos)>0)
                                @foreach($eventos as $evento)
                                    <div class="col-sm-3 col-md-3 col-xs-3">
                                        <a data-toggle="modal" data-target="#evento{{$evento->id}}">
                                            <img src="{{ url('uploads/clases') }}/{{ $evento->imagen }}"
                                                 class="img-responsive">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="row condominios-clases">
                                    <div class="col-lg-12">
                                        <p style="text-align: center">No hay más eventos disponibles</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                @include('holders.notificaciones')
            </div>
            <p>&nbsp;</p>
            <div class="teamItemWrap clear">

            </div>
        </div>
    </section>
@endsection


@section('modals')
    @include('condominio.partials.clases')
    @include('condominio.partials.clases_room')
    @include('condominio.partials.eventos')
    @foreach ($condominio->residenciales as $residencial)
        @if ($residencial->tipo=="Residencial")
            <div class="modal fade" id="residencial{{$condominio->id}}{{$residencial->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body  residencial">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>
                            <div class="container-bootstrap" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-8 sidebar">
                                        <div class="text-center">
                                            <div class="title">
                                                {{$residencial->clase->nombre}}

                                            </div>
                                            <div class="profile-userpic">
                                                <img src="{{ url('uploads/avatars') }}/{{ $residencial->user->detalles->photo }}"
                                                     class="img-responsive" alt="">
                                            </div>
											<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                            <h2>{{ucfirst($nombre[0])}}</h2>


                                        </div>


                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">
                                        <div class="title pull-right">
                                            ${{$residencial->precio}}
                                        </div>
                                    <!--img src="{{ url('uploads/condominios') }}/{{ $residencial->condominio->imagen }}" class="img-responsive"-->
                                        <form action="{{url('carrito')}}" onsubmit="fbq('track', 'AddToCart');"
                                              method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="residencial_id" value="{{$residencial->id}}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="residencial_id" value="{{$residencial->id}}">
                                            <input type="hidden" name="tipo" value="Residencial">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <input type="submit" class="btn btn-success btn-lg" name=""
                                                           value="Reservar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 sidebar  ">
                                        <div class="gotham2 text-center">
                                            <p>Hora: {{$residencial->hora}}</p>
                                            <p>Lugar: {{$residencial->condominio->identificador}}
                                                <br>{{$residencial->condominio->direccion}}</p>
                                            <p>
                                                Lugares
                                                disponibles: {{intval($residencial->cupo)-intval($residencial->ocupados)}}
                                            </p>
                                            <p>Audiencia: {{$residencial->audiencia}}</p>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 sidebar">
                                        <div class="gotham2 textoevento text-center">
                                            <p style="line-height: 1;"><span>Descripción:</span> <br><span
                                                        class="menor">{!!$residencial->descripcion!!}</span></p>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 sidebar visible-xs visible-sm">
                                        <div class="title pull-right">
                                            ${{$residencial->precio}}
                                        </div>

                                        <form action="{{url('carrito')}}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="residencial_id" value="{{$residencial->id}}">
                                            <input type="hidden" name="tipo" value="Residencial">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <input type="submit" class="btn btn-success btn-lg" name=""
                                                           value="Reservar">
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal contraseña -->
        @endif
    @endforeach
    <script type="text/javascript">
        clasesseleccionadas = 0;

        function agregaracarrito(valor, valor2, valor3) {
            if (document.getElementById('carrito' + valor).checked) {
                document.getElementById('carrito' + valor).checked = false;
                $('#carrito' + valor).removeClass('seleccionada');
                $('.fa' + valor).removeClass('fa-square');
                $('.fa' + valor).addClass('fa-square-o');
                if (clasesseleccionadas > 0) {
                    clasesseleccionadas--;
                }
                $('#cantidad' + valor3).val(clasesseleccionadas);
                $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                if (clasesseleccionadas <= 0) {
                    $('#reservar' + valor3).prop("disabled", true);
                    $('.reservar' + valor3).prop("disabled", true);
                }
            }
            else {
                document.getElementById('carrito' + valor).checked = true;
                $('#carrito' + valor).addClass('seleccionada');
                $('.fa' + valor).removeClass('fa-square-o');
                $('.fa' + valor).addClass('fa-square');
                clasesseleccionadas++;
                $('#cantidad' + valor3).val(clasesseleccionadas);
                $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                $('#reservar' + valor3).prop("disabled", false);
                $('.reservar' + valor3).prop("disabled", false);
            }
        }

        function acero() {
            clasesseleccionadas = 0;
            $('.clasesseleccionadas').html("0 clases seleccionadas.");
            $('.faselect').removeClass('fa-square');
            $('.faselect').removeClass('fa-square-o');
            $('.faselect').addClass('fa-square-o');
            document.getElementsByClassName('carritocheck').checked = false;
        }
    </script>
@endsection
