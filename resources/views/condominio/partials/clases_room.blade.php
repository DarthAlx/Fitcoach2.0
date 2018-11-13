@foreach($rooms as $room)
    <div class="modal fade" id="calendario-room{{$room->id}}" tabindex="-1" role="dialog">
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
                                <form action="{{url('carrito')}}" onsubmit="fbq('track', 'AddToCart');" method="post">
                                    {!! csrf_field() !!}

                                    <h1 class="title">{{ucfirst($room->nombre)}} </h1>


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
																				<?php $residenciales = App\Services\RoomService::getHoursByCondominio( $condominio->id, $room->id );
																				list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																				$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																				?>
                                                                                @foreach ($residenciales as $residencial)
                                                                                    @if ($residencial->ocupados<$residencial->cupo)
                                                                                        @if ($residencial->fecha==$fechas[$x])
																							<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                            <li class="list-group-item text-center"
                                                                                                onclick="agregaracarrito45('{{$x}}{{$residencial->id}}{{$i}}','{{$residencial->grupo_id}}','{{$condominio->id}}');"
                                                                                                style="cursor:pointer;">
                                                                                                <input type="checkbox"
                                                                                                       class="carrito-23check"
                                                                                                       id="carrito-23{{$x}}{{$residencial->id}}{{$i}}"
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
                                                       href="#myCarousel{{$condominio->id}}" data-slide="prev"><em
                                                                class="fa fa-2x fa-chevron-left" aria-hidden="true"
                                                                style="color: #000;"></em>
                                                    </a>
                                                    <a class="right carousel-control"
                                                       href="#myCarousel{{$condominio->id}}" data-slide="next"><em
                                                                class="fa fa-2x fa-chevron-right" aria-hidden="true"
                                                                style="color: #000;"></em>
                                                    </a>
                                        </div>
                                    </div>


                                    <div id="myCarouselmini{{$condominio->id}}" class="carousel slide visible-xs"
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
																				<?php $residenciales = App\Services\RoomService::getHoursByCondominio( $condominio->id, $room->id );
																				list( $año, $mes, $dia ) = explode( "-", $fechas[ $x ] );
																				$dia_n = date( "w", mktime( 0, 0, 0, $mes, $dia, $año ) );
																				?>
                                                                                @foreach ($residenciales as $residencial)
                                                                                    @if ($residencial->ocupados<$residencial->cupo)
                                                                                        @if ($residencial->fecha==$fechas[$x])
																							<?php $nombre = explode( " ", $residencial->user->name ); ?>
                                                                                            <li class="list-group-item text-center"
                                                                                                onclick="agregaracarrito45('{{$x}}{{$residencial->id}}{{$i}}mini','{{$residencial->grupo_id}}','{{$condominio->id}}');"
                                                                                                style="cursor:pointer;">
                                                                                                <input type="checkbox"
                                                                                                       class="carrito-23check"
                                                                                                       id="carrito-23{{$x}}{{$residencial->id}}{{$i}}mini"
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
                                                       href="#myCarouselmini{{$condominio->id}}" data-slide="prev"><em
                                                                class="fa fa-2x fa-chevron-left" aria-hidden="true"
                                                                style="color: #000;"></em>
                                                    </a>
                                                    <a class="right carousel-control"
                                                       href="#myCarouselmini{{$condominio->id}}" data-slide="next"><em
                                                                class="fa fa-2x fa-chevron-right" aria-hidden="true"
                                                                style="color: #000;"></em>
                                                    </a>
                                        </div>
                                        <input type="hidden" name="cantidad" id="cantidad{{$condominio->id}}">
                                        <p>&nbsp;</p>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div id="clasesseleccionadasroom{{$condominio->id}}"
                                                     class="clasesseleccionadasroom title text-center">
                                                    0 clases seleccionadas.
                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                            <div class="col-sm-4">
                                                <input type="submit"
                                                       class="btn btn-success btn-lg reservar{{$condominio->id}}"
                                                       name=""
                                                       value="Reservar" disabled>
                                            </div>
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
    <script type="text/javascript">
        clasesseleccionadasroom = 0;

        function agregaracarrito45(valor, valor2, valor3) {
            if (document.getElementById('carrito-23' + valor).checked) {
                document.getElementById('carrito-23' + valor).checked = false;
                $('#carrito-23' + valor).removeClass('seleccionada');
                $('.fa' + valor).removeClass('fa-square');
                $('.fa' + valor).addClass('fa-square-o');
                if (clasesseleccionadasroom > 0) {
                    clasesseleccionadasroom--;
                }
                $('#cantidad' + valor3).val(clasesseleccionadasroom);
                $('#clasesseleccionadasroom' + valor3).html(clasesseleccionadasroom + " clases seleccionadas.");
                if (clasesseleccionadasroom <= 0) {
                    $('#reservar' + valor3).prop("disabled", true);
                    $('.reservar' + valor3).prop("disabled", true);
                }
            }
            else {
                document.getElementById('carrito-23' + valor).checked = true;
                $('#carrito-23' + valor).addClass('seleccionada');
                $('.fa' + valor).removeClass('fa-square-o');
                $('.fa' + valor).addClass('fa-square');
                clasesseleccionadasroom++;
                $('#cantidad' + valor3).val(clasesseleccionadasroom);
                $('#clasesseleccionadasroom' + valor3).html(clasesseleccionadasroom + " clases seleccionadas.");
                $('#reservar' + valor3).prop("disabled", false);
                $('.reservar' + valor3).prop("disabled", false);
            }
        }

        function acero() {
            clasesseleccionadasroom = 0;
            $('.clasesseleccionadasroom').html("0 clases seleccionadas.");
            $('.faselect').removeClass('fa-square');
            $('.faselect').removeClass('fa-square-o');
            $('.faselect').addClass('fa-square-o');
            document.getElementsByClassName('carrito-23check').checked = false;
        }
    </script>
@endforeach


