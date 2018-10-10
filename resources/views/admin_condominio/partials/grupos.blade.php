<div class="modal fade" id="admin-condominios-grupos" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>GRUPOS <span style="color: #cdcdcd">{!! $condominio->identificador !!}</span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <a href="#" class="btn btn-success btn-lg hidden-xs btn-crear-grupo" style="max-width: 200px;">Agregar grupo</a>
                        <a href="#" class="btn btn-success btn-lg visible-xs btn-crear-grupo" >Agregar grupo</a>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="adv-table table-responsive" style="padding-left: 10px;padding-right: 10px;">
                        <table class="display table table-bordered table-striped table-hover" id="dynamic-table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Clase</th>
                                <th>Coach</th>
                                <th>Room</th>
                                <th>Costo</th>
                                <th>Aforo promedio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($grupos)
                                @foreach ($grupos as $grupo)
                                    <tr style="cursor: pointer;" class="ver-grupo" data-id="{{$grupo->id}}">
                                        <td>{{ucfirst($grupo->nombre)}}</td>
                                        <td>
                                            @if(isset($grupo->clase))
                                                {{$grupo->clase->nombre}}
                                            @else
                                                <span></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($grupo->coach))
                                                {{$grupo->coach->name}}
                                            @else
                                                <span></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($grupo->room))
                                                {{$grupo->room->nombre}}
                                            @else
                                                <span></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($grupo->tokens==0)
                                                <span>No</span>
                                            @else
                                                <span>Si</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($grupo!=null)
                                                {{$grupo->aforoPromedio()->promedio}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Condominio</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
