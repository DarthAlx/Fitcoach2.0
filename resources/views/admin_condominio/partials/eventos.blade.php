<div class="modal fade" id="admin-condominios-eventos" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                            src="{{url('/images/cross.svg')}}" alt=""></button>
                <div class="row">
                    <div class="col-sm-9">
                        <h3>EVENTOS <span style="color: #cdcdcd">{!! $condominio->identificador !!}</span></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <button type="button" name="button" class="btn btn-success" data-toggle="modal"
                                data-dismiss="modal" data-target="#crear-evento">Agregar evento
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="adv-table table-responsive" style="padding-left: 10px;padding-right: 10px;">
                        <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Cupo</th>
                                <th>Ocupados</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($eventos)
                                @foreach ($eventos as $evento)
                                    <tr style="cursor: pointer;">
                                        <td>{{$evento->nombre}}</td>
                                        <td>{{$evento->fecha}} {{$evento->hora}}</td>
                                        <td>{{$evento->precio}}</td>
                                        <td>{{$evento->cupo}}</td>
                                        <td>{{$evento->ocupados}}</td>
                                        <td>
                                            <button type="button" name="button" class="btn btn-primary"
                                                    data-dismiss="modal" data-toggle="modal"
                                                    data-target="#editar-evento{{$evento->id}}">Editar
                                            </button>
                                            <a href="#" class="btn btn-danger"
                                               onclick="javascript: document.getElementById('botoneliminar{{ $evento->id }}').click();">Borrar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr style="cursor: pointer;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Cupo</th>
                                <th>Ocupados</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
count($condominio->eventos)>0)
@foreach($condominio->eventos as $evento)
    <div class="modal fade" id="admin-condominios-evento-ver{{$evento->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>RESERVACIONES Y ASISTENCIA
                                <span style="color: #cdcdcd">{!! $evento->id !!}</span>
                                &nbsp;
                                <a target="_blank" href="{{url('/listainscritos')}}/{{$evento->id}}?tipo=evento">
                                    <i style="color: #000000" class="fa fa-print"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <b>Fecha:</b> {{$evento->fecha}}
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <b>Hora:</b> {{$evento->hora}}
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <b>Precio:</b> {{$evento->precio}}
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <b>Cliente: </b> {{$evento->condominio->identificador}}
                        </div>

                    </div>
                    <p></p>
                    <b>RESERVACIONES</b>
                    <br/>
                    <br/>
                    @foreach ($evento->asistentes as $asistente)
                        <div class="row">
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
                </div>
            </div>
        </div>
    </div>

@endforeach
