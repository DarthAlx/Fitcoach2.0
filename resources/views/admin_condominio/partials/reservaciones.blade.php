@foreach($grupos as $grupo)
    @foreach($grupo->horarios as $horario)
        @foreach($horario->reservaciones as $reservacion)
            @if($horario->clase!=null)
                <div class="modal fade" id="admin-condominios-horarios-ver{{$reservacion->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>RESERVACIONES Y ASISTENCIA
                                            <span style="color: #cdcdcd">{!! $horario->id !!}</span>
                                            &nbsp;
                                            <a target="_blank"
                                               href="{{url('/listainscritos')}}/{{$reservacion->id}}?tipo=clase">
                                                <i style="color: #000000" class="fa fa-print"></i>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-3">
                                        <b>Clase:</b> {{$horario->clase!=null?$horario->clase->nombre:''}}
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
                                    @if($asistente->reserva)
                                        @if($asistente->estado!='CANCELADA')
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
                                        @endif
                                    @endif
                                @endforeach
                                <br/>
                                <br/>
                                <b>ASISTENTES SIN RESERVACIÓN</b>
                                <br/>
                                <br/>
                                @foreach ($reservacion->invitados as $invitado)
                                    <div class="row">
                                        <div class="col-sm-1">
                                                <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="col-sm-4">
                                            {{$invitado->nombre}}
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1">
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($reservacion->asistentes as $asistente)
                                    @if(!$asistente->reserva)
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
                                    @endif
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
                                    @if(isset($reservacion->plan))
                                        <a target="_blank"
                                           href="{{url('/printplan')}}/{{$reservacion->id}}?tipo=clase">
                                            <i style="color: #000000" class="fa fa-print"></i>
                                        </a>
                                    @endif

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
                                                    <div class="col-sm-6">
                                                        <label>Objetivos</label>
                                                        <textarea name="objetivos" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->objetivos}}
                                        </textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Materiales</label>
                                                        <textarea name="materiales" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->materiales}}
                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Fase inicial</label>
                                                        <textarea name="inicio" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->inicio}}</textarea>
                                                        <label>Minutos</label>
                                                        <input type="number" class="form-control" name="minutosinicio"
                                                               required
                                                               value="{{$reservacion->plan->minutosinicio}}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Fase medular</label>
                                                        <textarea name="medular" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->medular}}</textarea>
                                                        <label>Minutos</label>
                                                        <input type="number" class="form-control" name="minutosmedular"
                                                               required
                                                               value="{{$reservacion->plan->minutosmedular}}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Fase final</label>
                                                        <textarea name="final" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->final}}</textarea>
                                                        <label>Minutos</label>
                                                        <input type="number" class="form-control" name="minutosfinal"
                                                               value="{{$reservacion->plan->minutosfinal}}" required
                                                               readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Comentarios</label>
                                                        <textarea name="comentarios" class="form-control" required rows="4"
                                                                  readonly>{{$reservacion->plan->comentarios}}</textarea>
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
                <div class="modal fade" id="mensajes{{$reservacion->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                            src="{{url('/images/cross.svg')}}" alt=""></button>
                                <h4>MENSAJES
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
                                        @if(count($reservacion->mensajes)>0)
                                            <div class="col-md-12" style="height: 200px;overflow-y: scroll">
                                                @foreach($reservacion->mensajes as $mensaje)
                                                    <b>{{$mensaje->created_at}}</b><br/>
                                                    <p>
                                                        {{$mensaje->mensaje}}
                                                    </p>
                                                    <hr/>
                                                @endforeach
                                            </div>
                                        @else
                                            <span>NO HAY MENSAJES</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <h4>NUEVO MENSAJE</h4>
                                        <div class="col-lg-12">
                                            <form action="{{ url('/admin-condominio/agregar-mensaje') }}" method="post"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <textarea name="mensaje" class="form-control"
                                                          placeholder="Mensaje"></textarea>
                                                <input type="hidden" name="reservacion_id" value="{{$reservacion->id}}">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <button class="btn btn-success" type="submit"
                                                        style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                                    Enviar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.modal-content -->

                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal contraseña -->
                </div>
            @endif
        @endforeach
    @endforeach
@endforeach