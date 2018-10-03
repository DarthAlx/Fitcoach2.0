@foreach($grupos as $grupo)
    @foreach($grupo->horarios as $horario)
    <div class="modal fade" id="admin-condominios-horarios-ver{{$horario->id}}" tabindex="-1" role="dialog">
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
                            <b>Cliente:</b>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <b>Fecha:</b> {{$horario->fecha}}
                        </div>
                    </div>
                    <p> </p>
                    <b>RESERVACIONES</b>
                    @foreach ($horario->reservaciones as $reservacion)
                    <div class="row">
                        <div class="adv-table table-responsive" style="padding-left: 10px;padding-right: 10px;">
                            <table class="table-responsive" >
                                <thead>
                                </thead>
                                <tbody>
                                @foreach ($horario->reservaciones as $reservacion)
                                    <tr style="cursor: pointer;" data-toggle="modal" data-target="#grupo{{$horario->id}}">
                                        <td>{{$reservacion->user->name}}</td>
                                        <td>{{$reservacion->user->genero}}</td>
                                        <td>{{$reservacion->user->email}}</td>
                                        <td>{{$reservacion->user->tel}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


@endforeach
@endforeach