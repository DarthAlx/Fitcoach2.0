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