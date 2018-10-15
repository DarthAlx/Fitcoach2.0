@foreach($grupos as $grupo)
    @foreach($grupo->horarios as $horario)
        @foreach($horario->reservaciones as $reservacion)
            <div class="modal fade" id="admin-condominios-horarios-ver{{$reservacion->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>RESERVACIONES Y ASISTENCIA
                                        <span style="color: #cdcdcd">{!! $horario->clase->nombre !!}</span>
                                    </h4>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                    <b>Clase:</b> {{$horario->clase->nombre}}
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <b>Coach:</b> {{$horario->user->name}}
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <b>Cliente: </b> {{$horario->condominio->identificador}}
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <b>Fecha:</b> {{$horario->fecha}}
                                </div>
                            </div>
                            <p></p>
                            <b>RESERVACIONES</b>
                            <br/>
                            <br/>
                            @foreach ($reservacion->asistentes as $asistente)
                                <div class="row">
                                    <div class="col-sm-1">
                                        @if($asistente->asistencia)
                                            <i class="fa fa-check-circle"></i>
                                        @else
                                            <i class="fa fa-times-circle"></i>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        {{$asistente->usuario->name}}
                                    </div>
                                    <div class="col-sm-2">
                                        {{$asistente->usuario->genero}}
                                    </div>
                                    <div class="col-sm-3">
                                        {{$asistente->usuario->email}}
                                    </div>
                                    <div class="col-sm-1">
                                        {{$asistente->usuario->tel}}
                                    </div>
                                </div>
                            @endforeach
                            <br/>
                            <br/>
                            <b>ASISTENTES SIN RESERVACIÓN</b>
                            <br/>
                            <br/>
                            @foreach ($reservacion->invitados as $invitado)
                                <div class="row">
                                    <div class="col-sm-4">
                                        {{$invitado->nombre}}
                                    </div>
                                    <div class="col-sm-2">
                                        {{$invitado->genero}}
                                    </div>
                                    <div class="col-sm-3">
                                        {{$invitado->email}}
                                    </div>
                                    <div class="col-sm-2">
                                        {{$invitado->telefono}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="proximas{{$reservacion->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>
                            <h4>PLAN DE SESIÓN
                                <span style="color: #cdcdcd">{!! $horario->clase->nombre !!}</span>
                            </h4>
                            <div class="container-bootstrap" style="width: 100%;padding-top: 50px">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-3">
                                        <b>Clase:</b> {{$horario->clase->nombre}}
                                    </div>
                                    <div class="col-lg-3 col-sm-3">
                                        <b>Coach:</b> {{$horario->user->name}}
                                    </div>
                                    <div class="col-lg-3 col-sm-3">
                                        <b>Cliente: </b> {{$horario->condominio->identificador}}
                                    </div>
                                    <div class="col-lg-3 col-sm-3">
                                        <b>Fecha:</b> {{$horario->fecha}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    @if(isset($reservacion->plan))
                                        <div class="col-md-12">
                                            <b>PLAN DE LA CLASE</b>
                                            <br/>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Fase Inicial
                                                </div>
                                                <div class="col-md-3">
                                                    {{$reservacion->plan->minutosinicio}}
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$reservacion->plan->inicio}}</p>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Fase medular
                                                </div>
                                                <div class="col-md-3">
                                                    {{$reservacion->plan->minutosmedular}}
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$reservacion->plan->medular}}</p>
                                                </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    Fase Final
                                                </div>
                                                <div class="col-md-3">
                                                    {{$reservacion->plan->minutosfinal}}
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$reservacion->plan->final}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div><!-- /.modal-content -->

                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal contraseña -->
            </div>
        @endforeach
    @endforeach
@endforeach