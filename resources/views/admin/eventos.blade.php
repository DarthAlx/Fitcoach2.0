@extends('plantilla')
@section('pagecontent')
    <section class="container">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="row profile">
            <div class="col-sm-12">
                @include('holders.notificaciones')
            </div>
        </div>
        <div class="">
            <div class="container-bootstrap-fluid">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">EVENTOS</div>
                    </div>

                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div class="row">
                    <button type="button" name="button" class="btn btn-default" data-toggle="modal"
                            data-target="#nuevo">Agregar evento
                    </button>

                </div>


                <div class="row">
                    <div class="adv-table table-responsive">
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
                                            <button type="button" name="button" class="btn btn-info"
                                                    data-toggle="modal" data-target="#admin-evento-ver{{$evento->id}}">Ver
                                            </button>
                                            <button type="button" name="button" class="btn btn-primary"
                                                    data-toggle="modal" data-target="#evento{{$evento->id}}">Editar
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
            <p>&nbsp;</p>

        </div>
    </section>
@endsection

@section('modals')



    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>

                    <div>
                        <h4>Agregar evento</h4>
                        <form action="{{ url('/agregar-evento') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>

                            <textarea name="descripcion" class="form-control" placeholder="Descripción"
                                      required>{{ old('descripcion') }}</textarea>

                            <input type="text" name="fecha" class="form-control datepicker" placeholder="Fecha"
                                   required>
                            <input type="text" name="hora" class="form-control mitimepicker" placeholder="Hora"
                                   required>
                            <input type="text" name="precio" class="form-control" placeholder="Precio" required>
                            <input type="text" name="cupo" class="form-control" placeholder="Cupo" required>
                            <textarea name="direccion" class="form-control"
                                      placeholder="Dirección">{{ old('direccion') }}</textarea>

                            <label class="col-sm-3 control-label">Imágen </label>
                            <input class="form-control" type="file" name="imagen" required>


                            <button class="btn btn-success" type="submit"
                                    style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                Crear
                            </button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal pago-->




    @if ($eventos)
        @foreach ($eventos as $evento)
            <div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                        src="{{url('/images/cross.svg')}}" alt=""></button>

                            <div>
                                <h4>Editar evento</h4>

                                <form action="{{ url('/actualizar-evento') }}" method="post"
                                      enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="evento" value="{{ $evento->id }}">

                                    <input type="text" name="nombre" class="form-control"
                                           value="{{ $evento->nombre or old('nombre') }}" placeholder="Nombre" required>

                                    <textarea name="descripcion" class="form-control" placeholder="Descripción"
                                              required>{{ $evento->descripcion or old('descripcion') }}</textarea>

                                    <input type="text" name="fecha" class="form-control datepicker"
                                           value="{{ $evento->fecha or old('fecha') }}" placeholder="Fecha" required>
                                    <input type="text" name="hora" class="form-control mitimepicker"
                                           value="{{ $evento->hora or old('hora') }}" placeholder="Hora" required>
                                    <input type="text" name="precio" class="form-control"
                                           value="{{ $evento->precio or old('precio') }}" placeholder="Precio" required>
                                    <input type="text" name="cupo" class="form-control"
                                           value="{{ $evento->cupo or old('cupo') }}" placeholder="Cupo" required>
                                    <script>
                                        document.getElementById('condominio{{$evento->id}}').value = "{{ $evento->id or old('condominio_id') }}";
                                    </script>
                                    <textarea name="direccion" class="form-control"
                                              placeholder="Dirección">{{ $evento->descripcion or old('descripcion') }}</textarea>

                                    <label class="col-sm-3 control-label">Imagen (solo si se desea reemplazar)</label>
                                    <input class="form-control" type="file" name="imagen">

                                    <button class="btn btn-success" type="submit"
                                            style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                        Actualizar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal pago-->
            <div class="modal fade" id="admin-evento-ver{{$evento->id}}" tabindex="-1" role="dialog">
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
    @endif

    @if ($eventos)
        @foreach ($eventos as $evento)
            <form style="display: none;" action="{{ url('/eliminar-evento') }}" method="post">
                {!! csrf_field() !!}
                {{ method_field('DELETE') }}
                <input type="hidden" name="evento" value="{{ $evento->id }}">
                <input type="submit" id="botoneliminar{{ $evento->id }}">
            </form>
        @endforeach
    @endif







@endsection
