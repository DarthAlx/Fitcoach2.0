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
                        <div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">COACHES</div>
                        <div class="buscador hidden-xs" style="float: right; position: absolute; right: 0; bottom: 0;">
                            <div class="coupon">
                                <form action="{{url('buscarcoach')}}" onsubmit="fbq('track', 'Search');" method="post">
                                    {!! csrf_field() !!}
                                    <input class="" type="text" name="busqueda" value="" placeholder="Buscar...">
                                    <button class="applyCoupon" type="submit"><i class="fa fa-search" aria-hidden="true"
                                                                                 onblur="fbq('track', 'Search');"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3 visible-xs">
                        <div class="buscador">
                            <div class="coupon">
                                <form action="{{url('buscarcoach')}}" onsubmit="fbq('track', 'Search');" method="post">
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
                @include('holders.notificaciones')
            </div>
            <p>&nbsp;</p>
            <div class="teamItemWrap clear">
                @if ($coaches)

                    @foreach ($coaches as $coach)
                        <div class="teamItem">
                            @if($coach->detalles->photo!="")

                                <a><img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}" alt=""></a>
                            @else

                                <a><img src="{{ url('uploads/avatars') }}/dummy.png" alt=""></a>
                            @endif
                            <div class="overlay" data-toggle="modal" data-target="#coach{{$coach->id}}">
                                <div class="teamItemNameWrap">
									<?php $nombre = explode( " ", $coach->name ); ?>
                                    <a style="text-decoration:none;"><h3>{{ucfirst($nombre[0])}}</h3></a>
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
    @if ($coaches)
        @foreach ($coaches as $coach)
            <div class="modal fade" id="coach{{$coach->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>
                            <div class="container-bootstrap" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 sidebar">
                                        <div class="text-center">

                                            <div class="profile-userpic">
                                                @if($coach->detalles->photo!="")
                                                    <a><img src="{{ url('uploads/avatars') }}/{{ $coach->detalles->photo }}"
                                                            alt=""></a>
                                                @else
                                                    <a><img src="{{ url('uploads/avatars') }}/dummy.png" alt=""></a>
                                                @endif

                                            </div>
                                            <h2>{{ucfirst($coach->name)}} - {{$coach->detalles->rating}} <i
                                                        class="fa fa-star" aria-hidden="true"></i></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h1 class="gotham2">A domicilio</h1>
                                        @if ($coach->horarios)
                                            <a href="#" class="list-group-item" data-toggle="modal"
                                               data-target="#calendario{{$coach->id}}" onclick="acero();">Ver
                                                calendario</a>
                                        @else
                                            Este coach no tiene horarios disponibles.
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <h1 class="gotham2">En condominio</h1>
                                        @if ($coach->horarios)
                                            <a href="#" class="list-group-item" data-toggle="modal"
                                               data-target="#calendario2{{$coach->id}}" onclick="acero();">Ver
                                                calendario</a>
                                        @else
                                            Este coach no tiene horarios disponibles.
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal detalles user -->
        @endforeach
    @endif







    @if ($coaches)
        @foreach ($coaches as $coach)
            <div class="modal fade" id="calendario{{$coach->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog calendario" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>

							<?php
							$clase = App\Clase::find( $coach->detalles->clases );
							setlocale( LC_TIME, "es-MX" );
							date_default_timezone_set( 'America/Mexico_City' );
							$fecha = date( 'Y-m-d' );
							$fechas = array();
							$fechasformateadas = array();


							for ( $i = 0; $i < 30; $i ++ ) {
								$nuevafecha          = strtotime( '+' . ( $i + 1 ) . 'day', strtotime( $fecha ) );
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

                                            <h1 class="title">{{ucfirst($coach->name)}}</h1>

                                            <div id="myCarousel{{$coach->id}}" class="carousel slide hidden-xs"
                                                 data-wrap="false"><!--6 columnas-->
                                                <div class="carousel-inner">
                                                    @for ($i=0; $i < 5 ; $i++)
                                                        @if ($i==0)
                                                            <div class="item active">
                                                                @else
                                                                    <div class="item">
                                                                        @endif
                                                                        <div class="row-fluid">
                                                                            @for ($x=$i*6; $x < ($i+1)*6 ; $x++)
                                                                                <div class="col-sm-2 col-xs-6 separacion">
                                                                                    {{$fechasformateadas[$x]}}
                                                                                    <ul class="list-group calendarioinst">
																						<?php $particulares = App\Horario::where( 'tipo', 'A domicilio' )->where( 'user_id', $coach->id )->orderBy( 'hora', 'asc' )->get();
																						list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																						$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																						?>
                                                                                        @foreach ($particulares as $particular)
                                                                                            @if($particular->tipo!="En condominio")
																								<?php
																								$diaslibres = App\Libres::where( 'user_id', $particular->user_id )->get();
																								$libres = array();
																								foreach ( $diaslibres as $dialibre ) {
																									$libres[] = $dialibre->fecha;
																								}
																								?>
																								<?php $existe = App\Reservacion::where( 'coach_id', $particular->user_id )->where( 'fecha', $fechas[ $x ] )->where( 'hora', $particular->hora )->first(); ?>
                                                                                                @if (!$existe)
                                                                                                    @if (!in_array($fechas[$x], $libres) && ($particular->fecha==$fechas[$x]||in_array($dia_n, explode(",",$particular->recurrencia))))
                                                                                                        <li class="list-group-item"
                                                                                                            onclick="agregaracarrito('{{$x}}{{$particular->id}}{{$i}}','{{$coach->id}}','{{$clase->id}}');"
                                                                                                            style="cursor:pointer;">
                                                                                                            <input type="checkbox"
                                                                                                                   class="carritocheck"
                                                                                                                   id="carrito{{$x}}{{$particular->id}}{{$i}}"
                                                                                                                   name="carrito[]"
                                                                                                                   value="{{$particular->id}},{{$fechas[$x]}}"
                                                                                                                   style="display:none">
                                                                                                            <input type="hidden"
                                                                                                                   name="tipo"
                                                                                                                   value="Particular">
                                                                                                            {{$particular->clase->nombre}}

                                                                                                            <br>
                                                                                                            {{$particular->zona->identificador}}

                                                                                                            <br>
                                                                                                            {{$particular->hora}}
                                                                                                            <i class="fa fa-square-o faselect pull-right fa{{$x}}{{$particular->id}}{{$i}}"
                                                                                                               aria-hidden="true"></i>
                                                                                                        </li>
                                                                                                    @endif
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
                                                               href="#myCarousel{{$coach->id}}" data-slide="prev"><em
                                                                        class="fa fa-2x fa-chevron-left"
                                                                        aria-hidden="true" style="color: #000;"></em>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#myCarousel{{$coach->id}}" data-slide="next"><em
                                                                        class="fa fa-2x fa-chevron-right"
                                                                        aria-hidden="true" style="color: #000;"></em>
                                                            </a>
                                                </div><!--6columnas fin-->

                                                <div id="myCarouselmini{{$coach->id}}" class="carousel slide visible-xs"
                                                     data-wrap="false"><!--2 columnas-->
                                                    <div class="carousel-inner ">
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
																							<?php $particulares = App\Horario::where( 'tipo', 'A domicilio' )->where( 'user_id', $coach->id )->orderBy( 'hora', 'asc' )->get();
																							list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																							$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																							?>
                                                                                            @foreach ($particulares as $particular)
                                                                                                @if($particular->tipo!="En condominio")
																									<?php
																									$diaslibres = App\Libres::where( 'user_id', $particular->user_id )->get();
																									$libres = array();
																									foreach ( $diaslibres as $dialibre ) {
																										$libres[] = $dialibre->fecha;
																									}
																									?>
																									<?php $existe = App\Reservacion::where( 'coach_id', $particular->user_id )->where( 'fecha', $fechas[ $x ] )->where( 'hora', $particular->hora )->first(); ?>
                                                                                                    @if (!$existe)
                                                                                                        @if (!in_array($fechas[$x], $libres) && ($particular->fecha==$fechas[$x]||in_array($dia_n, explode(",",$particular->recurrencia))))
                                                                                                            <li class="list-group-item"
                                                                                                                onclick="agregaracarrito('{{$x}}{{$particular->id}}{{$i}}mini','{{$coach->id}}','{{$clase->id}}');"
                                                                                                                style="cursor:pointer;">
                                                                                                                <input type="checkbox"
                                                                                                                       class="carritocheck"
                                                                                                                       id="carrito{{$x}}{{$particular->id}}{{$i}}mini"
                                                                                                                       name="carrito[]"
                                                                                                                       value="{{$particular->id}},{{$fechas[$x]}}"
                                                                                                                       style="display:none">
                                                                                                                <input type="hidden"
                                                                                                                       name="tipo"
                                                                                                                       value="Particular">
                                                                                                                {{$particular->hora}}
                                                                                                                <i class="fa fa-square-o faselect pull-right fa{{$x}}{{$particular->id}}{{$i}}mini"
                                                                                                                   aria-hidden="true"></i>
                                                                                                            </li>
                                                                                                        @endif
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
                                                                   href="#myCarouselmini{{$coach->id}}"
                                                                   data-slide="prev"><em
                                                                            class="fa fa-2x fa-chevron-left"
                                                                            aria-hidden="true"
                                                                            style="color: #000;"></em>
                                                                </a>
                                                                <a class="right carousel-control"
                                                                   href="#myCarouselmini{{$coach->id}}"
                                                                   data-slide="next"><em
                                                                            class="fa fa-2x fa-chevron-right"
                                                                            aria-hidden="true"
                                                                            style="color: #000;"></em>
                                                                </a>
                                                    </div><!--2 columnas fin-->


                                                    <input type="hidden" name="cantidad" id="cantidad{{$coach->id}}">
                                                    <p>&nbsp;</p>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div id="clasesseleccionadas{{$clase->id}}"
                                                                 class="clasesseleccionadas title text-center">
                                                                0 clases seleccionadas.
                                                            </div>
                                                        </div>
                                                        <p>&nbsp;</p>
                                                        <div class="col-sm-4">
                                                            <input type="submit" class="btn btn-success btn-lg" name=""
                                                                   value="Reservar"
                                                                   id="reservar{{$coach->id}}{{$clase->id}}" disabled>
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

















            <div class="modal fade" id="calendario2{{$coach->id}}" tabindex="-1" role="dialog">
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

                                            <h1 class="title">{{ucfirst($coach->name)}} </h1>


                                            <div id="myCarousel2{{$coach->id}}" class="carousel slide hidden-xs"
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
																						<?php $residenciales = App\Horario::where( 'tipo', 'En condominio' )->where( 'user_id', $coach->id )->orderBy( 'hora', 'asc' )->get();
																						list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																						$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																						?>
                                                                                        @foreach ($residenciales as $residencial)
                                                                                            @if ($residencial->ocupados<$residencial->cupo)
                                                                                                @if ($residencial->fecha==$fechas[$x])
																									<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                                    <li class="list-group-item text-center"
                                                                                                        onclick="agregaracarrito2('{{$x}}{{$residencial->id}}{{$i}}','{{$coach->id}}','{{$clase->id}}');"
                                                                                                        style="cursor:pointer;">
                                                                                                        <input type="checkbox"
                                                                                                               class="carritocheck"
                                                                                                               id="carrito2{{$x}}{{$residencial->id}}{{$i}}"
                                                                                                               name="carrito[]"
                                                                                                               value="{{$residencial->id}},{{$fechas[$x]}},{{$residencial->tokens}}"
                                                                                                               style="display:none">
                                                                                                        <input type="hidden"
                                                                                                               name="tipo"
                                                                                                               value="En condominio">
                                                                                                        {{$residencial->clase->nombre}}
                                                                                                        <br>{{$residencial->condominio->identificador}}
                                                                                                        <br>{{$residencial->hora}}
                                                                                                        <i class="fa fa-square-o faselect pull-right fa2{{$x}}{{$residencial->id}}{{$i}}"
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
                                                               href="#myCarousel2{{$coach->id}}" data-slide="prev"><em
                                                                        class="fa fa-2x fa-chevron-left"
                                                                        aria-hidden="true" style="color: #000;"></em>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#myCarousel2{{$coach->id}}" data-slide="next"><em
                                                                        class="fa fa-2x fa-chevron-right"
                                                                        aria-hidden="true" style="color: #000;"></em>
                                                            </a>
                                                </div>
                                            </div>


                                            <div id="myCarouselmini2{{$coach->id}}" class="carousel slide visible-xs"
                                                 data-wrap="false">
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
																						<?php $residenciales = App\Horario::where( 'tipo', 'En condominio' )->where( 'user_id', $coach->id )->orderBy( 'hora', 'asc' )->get();
																						list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																						$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																						?>
                                                                                        @foreach ($residenciales as $residencial)
                                                                                            @if ($residencial->ocupados<$residencial->cupo)
                                                                                                @if ($residencial->fecha==$fechas[$x])
																									<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                                    <li class="list-group-item text-center"
                                                                                                        onclick="agregaracarrito2('{{$x}}{{$residencial->id}}{{$i}}mini','{{$coach->id}}','{{$clase->id}}');"
                                                                                                        style="cursor:pointer;">
                                                                                                        <input type="checkbox"
                                                                                                               class="carritocheck"
                                                                                                               id="carrito2{{$x}}{{$residencial->id}}{{$i}}mini"
                                                                                                               name="carrito[]"
                                                                                                               value="{{$residencial->id}},{{$fechas[$x]}},{{$residencial->tokens}}"
                                                                                                               style="display:none">
                                                                                                        <input type="hidden"
                                                                                                               name="tipo"
                                                                                                               value="En condominio">
                                                                                                        {{$residencial->clase->nombre}}
                                                                                                        <br>{{$residencial->condominio->identificador}}
                                                                                                        <br>{{$residencial->hora}}
                                                                                                        <i class="fa fa-square-o faselect pull-right fa2{{$x}}{{$residencial->id}}{{$i}}mini"
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
                                                               href="#myCarouselmini2{{$coach->id}}"
                                                               data-slide="prev"><em class="fa fa-2x fa-chevron-left"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#myCarouselmini2{{$coach->id}}"
                                                               data-slide="next"><em class="fa fa-2x fa-chevron-right"
                                                                                     aria-hidden="true"
                                                                                     style="color: #000;"></em>
                                                            </a>
                                                </div>
                                                <input type="hidden" name="cantidad" id="cantidad2{{$coach->id}}">
                                                <p>&nbsp;</p>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div id="clasesseleccionadas2{{$clase->id}}"
                                                             class="clasesseleccionadas title text-center">
                                                            0 clases seleccionadas.
                                                        </div>
                                                    </div>
                                                    <p>&nbsp;</p>
                                                    <div class="col-sm-4">
                                                        <input type="submit" class="btn btn-success btn-lg" name=""
                                                               value="Reservar"
                                                               id="reservar2{{$coach->id}}{{$clase->id}}" disabled>
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

                $('#cantidad' + valor2).val(clasesseleccionadas);
                $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                if (clasesseleccionadas <= 0) {
                    $('#reservar' + valor2 + valor3).prop("disabled", true);
                }
            }
            else {
                document.getElementById('carrito' + valor).checked = true;
                $('#carrito' + valor).addClass('seleccionada');
                $('.fa' + valor).removeClass('fa-square-o');
                $('.fa' + valor).addClass('fa-square');
                clasesseleccionadas++;
                $('#cantidad' + valor2).val(clasesseleccionadas);
                $('#clasesseleccionadas' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                $('#reservar' + valor2 + valor3).prop("disabled", false);
            }
        }

        clasesseleccionadas2 = 0;

        function agregaracarrito2(valor, valor2, valor3) {
            if (document.getElementById('carrito2' + valor).checked) {
                document.getElementById('carrito2' + valor).checked = false;
                $('#carrito2' + valor).removeClass('seleccionada');
                $('.fa2' + valor).removeClass('fa-square');
                $('.fa2' + valor).addClass('fa-square-o');
                if (clasesseleccionadas > 0) {
                    clasesseleccionadas--;
                }
                $('#cantidad2' + valor3).val(clasesseleccionadas);
                $('#clasesseleccionadas2' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                if (clasesseleccionadas <= 0) {
                    $('#reservar2' + valor2 + valor3).prop("disabled", true);
                }
            }
            else {
                document.getElementById('carrito2' + valor).checked = true;
                $('#carrito2' + valor).addClass('seleccionada');
                $('.fa2' + valor).removeClass('fa-square-o');
                $('.fa2' + valor).addClass('fa-square');
                clasesseleccionadas++;
                $('#cantidad2' + valor3).val(clasesseleccionadas);
                $('#clasesseleccionadas2' + valor3).html(clasesseleccionadas + " clases seleccionadas.");
                $('#reservar2' + valor2 + valor3).prop("disabled", false);
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
