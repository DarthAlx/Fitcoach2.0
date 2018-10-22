@extends('plantilla')
@section('pagecontent')
    <style>
        table {
            border: none !important;
        }

        td, th {
            border-left: none !important;
            border-right: none !important;
        }

        .table-striped > tbody > tr:nth-child(odd) {
            background-color: #ffffff !important;
        }
    </style>
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
                    <div class="col-sm-6">
                        <h2>Bienvenido a <span class="nombre">{{$condominio->identificador}}</span></h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <a class="btn btn-success btn-block" data-toggle="modal"
                                   data-target="#admin-condominios-eventos">
                                    Editar eventos
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <a class="btn btn-success btn-block" data-toggle="modal"
                                   data-target="#admin-condominios-grupos">
                                    Editar clases
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <button class="btn btn-success btn-block" type="submit">
                                    Reportes
                                </button>
                            </div>
                        </div>
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
                                <div class="col-lg-6">
                                    <a data-toggle="modal" data-target="#calendario-room{{$room->id}}">
                                        <img src="{{ url('uploads/rooms') }}/{{ $room->imagen }}"
                                             class="img-responsive">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h3>CLASES DE HOY</h3>
                        @foreach($horarios as $horario)
                            @foreach($horario->reservaciones as $reservacion)
                                <div class="row condominios-clases">
                                    <div class="col-lg-2">
                                        <b class="condominios-clases-text">{{$horario->clase->nombre}}</b>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="condominios-clases-text"> {{$horario->user->name}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="condominios-clases-text">{{$horario->grupo->room->nombre}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="condominios-clases-text">{{$horario->hora}}</p>
                                    </div>
                                    <div class="col-lg-1">
                                        <p class="condominios-clases-text">
                                            {{$horario->cupo-$horario->ocupados}}
                                        </p>
                                    </div>
                                    <div class="col-lg-3">
                                        <a data-toggle="modal"
                                           data-target="#admin-condominios-horarios-ver{{$reservacion->id}}">
                                            <i class="icon-classes-image fa fa-list-ul"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#">
                                            <i class="icon-classes-image fa fa-eye" data-toggle="modal"
                                               data-target="#proximas{{$reservacion->id}}"></i>
                                        </a>
                                        @if($reservacion->status=='PROXIMA')
                                            <a data-toggle="modal"
                                               data-target="#mensajes{{$reservacion->id}}">
                                                <i class="icon-classes-image fa fa-comments"></i>
                                            </a>
                                            <a href="/admin-condominio/cancelar/{{$reservacion->id}}">
                                                <i class="icon-classes-image fa fa-times"></i>
                                            </a>
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
                            @if(count($condominio->eventos)>0)
                                @foreach($condominio->eventos as $evento)
                                    <div class="col-sm-3 col-md-3">
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
    @include('admin_condominio.partials.grupos')
    @include('admin_condominio.partials.eventos')
    @include('admin_condominio.partials.crear_evento')
    @include('admin_condominio.partials.editar_evento')
    @include('admin_condominio.partials.crear_grupo')
    @include('admin_condominio.partials.horarios')
    @include('admin_condominio.partials.reservaciones')
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
    <script type="application/javascript">
        $('.btn-crear-grupo').click(function () {
            $('#admin-condominios-grupos').modal('hide')
            setTimeout(function () {
                $('#crear-grupo').modal('show');
            }, 500)
            //
        })
        $('.eliminar-grupo').click(function () {
            var id = $(this).attr("data-id");
            $('#admin-condominios-grupos').modal('hide');
            setTimeout(function () {
                $('#modal-eliminar-grupo' + id).modal('show');
            }, 500)
            //
        });
        $('.ver-grupo').click(function () {
            var id = $(this).attr("data-id");
            $('#admin-condominios-grupos').modal('hide')
            setTimeout(function () {
                $('#admin-condominios-grupos-ver' + id).modal('show');
            }, 500)
            //
        })
        $('.btn-crear-horario').click(function () {
            var id = $(this).attr("data-id");
            $('#admin-condominios-grupos-ver' + id).modal('hide');
            setTimeout(function () {
                $('#admin-condominios-grupos-crear' + id).modal('show');
            }, 500)
            //
        })
        $('.btn-actualizar-grupo').click(function () {
            var id = $(this).attr("data-id");
            $('#admin-condominios-grupos-ver' + id).modal('hide');
            setTimeout(function () {
                $('#admin-condominios-grupos-actualizar' + id).modal('show');
            }, 500)
            //
        })
        $('.btn-actualizar-grupo').click(function () {
            var id = $(this).attr("data-id");
            $('#admin-condominios-grupos-ver' + id).modal('hide');
            setTimeout(function () {
                $('#admin-condominios-grupos-actualizar' + id).modal('show');
            }, 500)
            //
        });


    </script>
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

@endsection
