@foreach($grupos as $grupo)
    <div class="modal fade" id="admin-condominios-grupos-ver{{$grupo->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close close-modal-horarios" data-id="{{$grupo->id}}"
                            aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>{{$grupo->nombre}} <span
                                        style="color: #cdcdcd">{!! $condominio->identificador !!}</span></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-right">
                            <button class="btn btn-block btn-success btn-lg btn-crear-horario" data-id="{{$grupo->id}}"
                                    style="max-width: 200px;">
                                Agregar horario
                            </button>
                        </div>
                        <div class="col-sm-3 text-right">
                            <button class="btn  btn-block btn-success btn-lg btn-actualizar-grupo"
                                    data-id="{{$grupo->id}}"
                                    style="max-width: 200px;">
                                Actualizar grupo
                            </button>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="adv-table table-responsive" style="padding-left: 10px;padding-right: 10px;">
                            <table class="display table table-bordered table-striped table-hover dynamic-table3">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cupo disponible</th>
                                    <th>Reservaciones</th>
                                    <th>Aforo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($grupo->horarios as $horario)
                                    <tr style="cursor: pointer;" data-toggle="modal"
                                        data-target="#grupo{{$horario->id}}">
                                        <td>{{$horario->fecha}}</td>
                                        <td>{{$horario->hora}}</td>
                                        <td>{{$horario->cupo-$horario->ocupados}}</td>
                                        <td>{{$horario->ocupados}}</td>
                                        <td>
                                            @if($horario->reservacion()!=null)
                                                @if($horario->reservacion()->status=='PROXIMA')
                                                    @if($horario->esCancelable())
                                                        <span>FALTA</span>
                                                    @else
                                                        <span>&nbsp;</span>
                                                    @endif
                                                @else
                                                    {{$horario->aforo()}}
                                                @endif</td>
                                            @endif

                                        <td>
                                            @if($horario->reservacion()!=null)
                                                <a data-toggle="modal"
                                                   data-target="#admin-condominios-horarios-ver{{$horario->reservacion()->id}}">
                                                    <i class="icon-classes-image fa fa-list-ul"></i>
                                                </a>
                                                <a data-toggle="modal" data-target="#">
                                                    <i class="icon-classes-image fa fa-eye" data-toggle="modal"
                                                       data-target="#proximas{{$horario->reservacion()->id}}"></i>
                                                </a>
                                                @if($horario->reservacion()->status=='PROXIMA')
                                                    <a data-toggle="modal"
                                                       data-target="#mensajes{{$horario->reservacion()->id}}">
                                                        <i class="icon-classes-image fa fa-comments"></i>
                                                    </a>
                                                    @if($horario->esCancelable())
                                                        <a href="/admin-condominio/cancelar/{{$horario->reservacion()->id}}">
                                                            <i class="icon-classes-image fa fa-times"></i>
                                                        </a>
                                                    @endif

                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cupo disponible</th>
                                    <th>Reservaciones</th>
                                    <th>Aforo</th>
                                    <th>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="admin-condominios-grupos-crear{{$grupo->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div>
                        <h4>Agregar horario</h4>
                        {!! Form::open(['url' => '/admin-condominio/grupos/agregar-horario']) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="form-control datepicker" type="text" value="{{ old('fecha') }}"
                               placeholder="Fecha" name="fecha" required>
                        <input id="horarioNuevo" value="{{ old('hora') }}"
                               class="form-control xmitimepicker" placeholder="Hora" type="text" name="hora"
                               required/>
                        <input type="hidden" name="user_id" value="{{$grupo->user_id}}">
                        <input type="hidden" name="clase_id" value="{{$grupo->clase_id}}">
                        <input type="hidden" name="grupo_id" value="{{$grupo->id}}">
                        <input type="hidden" name="condominio_id" value="{{$grupo->condominio_id}}">
                        <input type="hidden" name="audiencia" value="{{$grupo->audiencia}}">
                        <input type="hidden" name="cupo" value="{{$grupo->cupo}}">
                        <input type="hidden" name="tokens" value="{{$grupo->tokens}}">
                        <button class="btn btn-success" type="submit"
                                style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                            Guardar
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="admin-condominios-grupos-actualizar{{$grupo->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>

                    <div>
                        <form action="{{ url('/admin-condominio/actualizar-grupo') }}" method="post"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="text" id="nombre" class="form-control" name="nombre"
                                   placeholder="Nombre" value="{{$grupo->nombre or old('nombre') }}"
                                   required>

                            <input type="hidden" name="condominio_id" value="{{$condominio->id}}">
                            <select class="form-control" name="room_id" id="room_id{{ $grupo->id }}"
                                    required>
                                <option value="">Selecciona un room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->nombre }}</option>
                                @endforeach
                            </select>
                            <script type="text/javascript">

                                if (document.getElementById('room_id{{ $grupo->id }}') != null) document.getElementById('room_id{{ $grupo->id }}').value = '{!! $grupo->room_id !!}';
                            </script>

                            <select class="form-control select-coach" name="user_id" id="coach{{ $grupo->id }}"
                                    required>
                                <option value="">Selecciona un coach</option>
                                @foreach ($coaches as $coach)
                                    <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                @endforeach
                            </select>
                            <script type="text/javascript">
                                if (document.getElementById('coach{{ $grupo->id }}') != null) document.getElementById('coach{{ $grupo->id }}').value = '{!! $grupo->user_id !!}';
                            </script>
                            <select class="form-control select-class" name="clase_id" id="clases_id{{  $grupo->id }}"
                                    required>
                                <option value="">Selecciona una clase</option>
                                @foreach ($grupo->coach->clasesInstructor() as $clase)
                                    <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                                @endforeach
                            </select>
                            <script type="text/javascript">
                                if (document.getElementById('clases_id{{ $grupo->id }}') != null) document.getElementById('clases_id{{ $grupo->id }}').value = {!! $grupo->clase_id !!};
                            </script>
                            <select class="form-control" name="audiencia" id="audiencia{{  $grupo->id }}"
                                    required>
                                <option value="">Selecciona una audiencia</option>
                                <option value="Todos">Todos</option>
                                <option value="Adultos">Adultos</option>
                                <option value="Adolescentes">Adolescentes</option>
                                <option value="Niños">Niños</option>
                                <option value="Bebés">Bebés</option>
                            </select>
                            <script type="text/javascript">
                                if (document.getElementById('audiencia{{ $grupo->id }}') != null) document.getElementById('audiencia{{ $grupo->id }}').value = '{!! $grupo->audiencia !!}';
                            </script>
                            <input type="number" id="cupo" class="form-control" name="cupo"
                                   placeholder="Cupo" value="{{ $grupo->cupo }}" required>

                            <input type="number" id="tokens" class="form-control" name="tokens"
                                   placeholder="Tokens" value="{{ $grupo->tokens }}" required>


                            <textarea name="descripcion" class="form-control"
                                      rows="10">{{ $grupo->descripcion }}</textarea>

                            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit"
                                        style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important; width: 40%; display: inline-block;">
                                    Actualizar
                                </button>
                                <a href="#" class="btn btn-success"
                                   style="color: #fff !important; background-color: #d9534f !important; border-color: #d9534f !important; width: 40%; display: inline-block;"
                                   onclick="javascript: document.getElementById('botoneliminargrupo{{ $grupo->id }}').click();">Borrar</a>
                            </div>
                        </form>
                        <form style="display: none;" action="{{ url('/admin-condominio/eliminar-grupo') }}"
                              method="post">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                            <input type="submit" id="botoneliminargrupo{{ $grupo->id }}">
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal detalles user -->

@endforeach