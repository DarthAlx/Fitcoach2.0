@extends('plantilla')
@section('pagecontent')
    <section class="container">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="">
            <div class="container-bootstrap-fluid">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="title" style="font-size: 8vw; float: left; line-height: 0.8;">CONDOMINIOS</div>

                    </div>
                    <div class="col-sm-2">
                        <div class="buscador hidden-xs" style="float: right; position: absolute; right: 0;">
                            <div class="coupon">
                                <form action="{{url('buscarresidencial')}}" onsubmit="fbq('track', 'Search');"
                                      method="post">
                                    {!! csrf_field() !!}
                                    <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
                                    <button class="applyCoupon" type="submit"><i class="fa fa-search" aria-hidden="true"
                                                                                 onblur="fbq('track', 'Search');"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 visible-xs">
                        <div class="buscador">
                            <div class="coupon">
                                <form action="{{url('buscarresidencial')}}" onsubmit="fbq('track', 'Search');"
                                      method="post">
                                    {!! csrf_field() !!}
                                    <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
                                    <button class="applyCoupon" type="submit"><i class="fa fa-search" aria-hidden="true"
                                                                                 onblur="fbq('track', 'Search');"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                @include('holders.notificaciones')
            </div>
            <p>&nbsp;</p>
            <div class="teamItemWrap clear">
                @if ($condominios)
                    @foreach ($condominios as $condominio)
                        <div class="teamItem">
                            <a><img src="{{ url('uploads/condominios') }}/{{ $condominio->imagen }}"
                                    class="img-responsive"></a>
                            <div class="overlay">
                                <div class="teamItemNameWrap">

                                    <a href="/condominios/{{strtolower(urlencode($condominio->identificador))}}"
                                       style="text-decoration:none;"><h3>{{ucfirst($condominio->identificador)}}</h3>
                                    </a>
                                </div>
                                <!--p>Formativa</p-->
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection


@section('modals')
    @if ($condominios)
        @foreach ($condominios as $condominio)
            <div class="modal fade" id="calendario{{$condominio->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog calendario" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>
							<?php
							setlocale( LC_TIME, "es-MX" );
							date_default_timezone_set( 'America/Mexico_City' );
							$fecha = date( 'Y-m-d' );
							$fechas = array();
							$fechasformateadas = array();


							for ( $i = 0; $i < 30; $i ++ ) {
								$nuevafecha          = strtotime( '+' . ( $i + 0 ) . 'day', strtotime( $fecha ) );
								$nuevafecha          = date( 'Y-m-d', $nuevafecha );
								$format              = date( "d", strtotime( $nuevafecha ) );
								$numdias             = date( "w", strtotime( $nuevafecha ) );
								$nummeses            = date( "n", strtotime( $nuevafecha ) );
								$arraydia            = array( 'Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb' );
								$arraymes            = array(
									'Enero',
									'Febrero',
									'Marzo',
									'Abril',
									'Mayo',
									'Junio',
									'Julio',
									'Agosto',
									'Septiembre',
									'Octubre',
									'Noviembre',
									'Diciembre'
								);
								$num                 = $arraydia[ intval( $numdias ) ];
								$nummes              = $arraymes[ intval( $nummeses ) - 1 ];
								$fechas[]            = $nuevafecha;
								$fechasformateadas[] = ucfirst( $num . " " . $format . " " . $nummes );
							}

							?>
                            <div class="container-fluid" id="trabajo">

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{url('carrito')}}" onsubmit="fbq('track', 'AddToCart');"
                                              method="post">
                                            {!! csrf_field() !!}

                                            <h1 class="title">{{ucfirst($condominio->identificador)}} </h1>


                                            <div id="myCarousel{{$condominio->id}}" class="carousel slide hidden-xs"
                                                 data-wrap="false">
                                                <div class="carousel-inner">
                                                    @for ($i=0; $i < 5 ; $i++)
                                                        @if ($i==0)
                                                            <div class="item active">
                                                                @else
                                                                    <div class="item">
                                                                        @endif
                                                                        <div class="row-fluid">
                                                                            @for ($x=$i*6; $x < ($i+1)*6 ; $x++)
                                                                                <div class="col-sm-2 col-xs-4 separacion">
                                                                                    {{$fechasformateadas[$x]}}
                                                                                    <ul class="list-group calendarioinst">
																						<?php $residenciales = App\Horario::where( 'tipo', 'En condominio' )->where( 'condominio_id', $condominio->id )->orderBy( 'hora', 'asc' )->get();
																						list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																						$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																						?>
                                                                                        @foreach ($residenciales as $residencial)
                                                                                            @if ($residencial->ocupados<$residencial->cupo)
                                                                                                @if ($residencial->fecha==$fechas[$x])
																									<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                                    <li class="list-group-item text-center"
                                                                                                        onclick="agregaracarrito('{{$x}}{{$residencial->id}}{{$i}}','{{$residencial->grupo_id}}','{{$condominio->id}}');"
                                                                                                        style="cursor:pointer;">
                                                                                                        <input type="checkbox"
                                                                                                               class="carritocheck"
                                                                                                               id="carrito{{$x}}{{$residencial->id}}{{$i}}"
                                                                                                               name="carrito[]"
                                                                                                               value="{{$residencial->id}},{{$fechas[$x]}},{{$residencial->tokens}}"
                                                                                                               style="display:none">
                                                                                                        <input type="hidden"
                                                                                                               name="tipo"
                                                                                                               value="En condominio">
                                                                                                        {{$residencial->clase!=null?$residencial->clase->nombre:''}}
                                                                                                        <br>{{ucfirst($nombre[0])}}
                                                                                                        <br>{{$residencial->hora}}
                                                                                                        <i class="fa fa-square-o faselect pull-right fa{{$x}}{{$residencial->id}}{{$i}}"
                                                                                                           aria-hidden="true"></i>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                    @endfor
                                                            </div>


                                                            <a class="left carousel-control"
                                                               href="#myCarousel{{$condominio->id}}"
                                                               data-slide="prev"><em class="fa fa-2x fa-chevron-left"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#myCarousel{{$condominio->id}}"
                                                               data-slide="next"><em class="fa fa-2x fa-chevron-right"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                </div>
                                            </div>


                                            <div id="myCarouselmini{{$condominio->id}}"
                                                 class="carousel slide visible-xs" data-wrap="false">
                                                <div class="carousel-inner">
                                                    @for ($i=0; $i < 15 ; $i++)
                                                        @if ($i==0)
                                                            <div class="item active">
                                                                @else
                                                                    <div class="item">
                                                                        @endif
                                                                        <div class="row-fluid">
                                                                            @for ($x=$i*2; $x < ($i+1)*2 ; $x++)
                                                                                <div class="col-xs-6 separacion">
                                                                                    {{$fechasformateadas[$x]}}
                                                                                    <ul class="list-group calendarioinst">
																						<?php $residenciales = App\Horario::where( 'tipo', 'En condominio' )->where( 'condominio_id', $condominio->id )->orderBy( 'hora', 'asc' )->get();
																						list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																						$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																						?>
                                                                                        @foreach ($residenciales as $residencial)
                                                                                            @if ($residencial->ocupados<$residencial->cupo)
                                                                                                @if ($residencial->fecha==$fechas[$x])
																									<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                                    <li class="list-group-item text-center"
                                                                                                        onclick="agregaracarrito('{{$x}}{{$residencial->id}}{{$i}}mini','{{$residencial->grupo_id}}','{{$condominio->id}}');"
                                                                                                        style="cursor:pointer;">
                                                                                                        <input type="checkbox"
                                                                                                               class="carritocheck"
                                                                                                               id="carrito{{$x}}{{$residencial->id}}{{$i}}mini"
                                                                                                               name="carrito[]"
                                                                                                               value="{{$residencial->id}},{{$fechas[$x]}},{{$residencial->tokens}}"
                                                                                                               style="display:none">
                                                                                                        <input type="hidden"
                                                                                                               name="tipo"
                                                                                                               value="En condominio">
                                                                                                        {{$residencial->clase!=null?$residencial->clase->nombre:''}}
                                                                                                        <br>{{ucfirst($nombre[0])}}
                                                                                                        <br>{{$residencial->hora}}
                                                                                                        <i class="fa fa-square-o faselect pull-right fa{{$x}}{{$residencial->id}}{{$i}}mini"
                                                                                                           aria-hidden="true"></i>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                    @endfor
                                                            </div>


                                                            <a class="left carousel-control"
                                                               href="#myCarouselmini{{$condominio->id}}"
                                                               data-slide="prev"><em class="fa fa-2x fa-chevron-left"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#myCarouselmini{{$condominio->id}}"
                                                               data-slide="next"><em class="fa fa-2x fa-chevron-right"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                </div>
                                                <input type="hidden" name="cantidad" id="cantidad{{$condominio->id}}">
                                                <p>&nbsp;</p>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div id="clasesseleccionadas{{$condominio->id}}"
                                                             class="clasesseleccionadas title text-center">
                                                            0 clases seleccionadas.
                                                        </div>
                                                    </div>
                                                    <p>&nbsp;</p>
                                                    <div class="col-sm-4">
                                                        <input type="submit" class="btn btn-success btn-lg" name=""
                                                               value="Reservar" id="reservar{{$condominio->id}}"
                                                               disabled>
                                                    </div>
                                                </div>
                                        </form>


                                    </div>


                                </div>
                            </div>

                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal detalles user -->
        @endforeach
    @endif
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



    @if ($condominios)
        @foreach ($condominios as $condominio)
            @foreach ($condominio->residenciales as $residencial)
                @if ($residencial->tipo=="Residencial")
                    <div class="modal fade" id="residencial{{$condominio->id}}{{$residencial->id}}" tabindex="-1"
                         role="dialog">
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
                                                    <input type="hidden" name="residencial_id"
                                                           value="{{$residencial->id}}">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="residencial_id"
                                                           value="{{$residencial->id}}">
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
                                                    <input type="hidden" name="residencial_id"
                                                           value="{{$residencial->id}}">
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
        @endforeach

    @endif

@endsection
