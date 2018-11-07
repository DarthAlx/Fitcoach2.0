@foreach($proximas as $proxima)
    <div class="modal fade" id="plan{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;">
                        <h4>Planear clase</h4>
                        <form action="{{ url('/planear-clase') }}" method="post" enctype="multipart/form-data">
                            @if($proxima->plan)
                                {{ method_field('PUT') }}
                            @endif

                            @if(!$proxima->plan)
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Objetivos</label>
                                        <textarea name="objetivos" class="form-control" required rows="4"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Materiales</label>
                                        <textarea name="materiales" class="form-control" required rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Fase inicial</label>
                                        <textarea name="inicio" class="form-control" required rows="4"></textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosinicio" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Fase medular</label>
                                        <textarea name="medular" class="form-control" required rows="4"></textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosmedular" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Fase final</label>
                                        <textarea name="final" class="form-control" required rows="4"></textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosfinal" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Comentarios</label>
                                        <textarea name="comentarios" class="form-control" required rows="4"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="reservacion_id" value="{{$proxima->reservacionId}}"/>
                            @else
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Objetivos</label>
                                        <textarea name="objetivos" class="form-control" required rows="4">{{$proxima->plan->objetivos}}
                                        </textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Materiales</label>
                                        <textarea name="materiales" class="form-control" required rows="4">{{$proxima->plan->materiales}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Fase inicial</label>
                                        <textarea name="inicio" class="form-control" required
                                                  rows="4">{{$proxima->plan->inicio}}</textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosinicio" required
                                               value="{{$proxima->plan->minutosinicio}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Fase medular</label>
                                        <textarea name="medular" class="form-control" required
                                                  rows="4">{{$proxima->plan->medular}}</textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosmedular" required
                                               value="{{$proxima->plan->minutosmedular}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Fase final</label>
                                        <textarea name="final" class="form-control" required
                                                  rows="4">{{$proxima->plan->final}}</textarea>
                                        <label>Minutos</label>
                                        <input type="number" class="form-control" name="minutosfinal"
                                               value="{{$proxima->plan->minutosfinal}}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Comentarios</label>
                                        <textarea name="comentarios" class="form-control" required
                                                  rows="4">{{$proxima->plan->comentarios}}</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="reservacion_id" value="{{$proxima->id}}"/>
                            @endif
                            <button class="btn btn-success" type="submit"
                                    style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                Guardar
                            </button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="direccion{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;">
                        <h4>Dirección</h4>
                        <h2 class="text-center">Lugar: {{ $proxima->lugar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($proxima->tipo=='reserva')
        <div class="modal fade" id="telefono{{$proxima->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                    src="{{url('/images/cross.svg')}}" alt=""></button>
                        <div class="container-bootstrap" style="width: 100%;">
                            <h4>Contacto telefónico</h4>
                            <h2 class="text-center">Teléfono: {{ $proxima->usuario->tel }}</h2>
                            <div class="text-center">
                                <a href="tel:{{ $proxima->usuario->tel }}" class="btn btn-primary">Llamar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="terminar{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="gotham2">
                                    <h2 class="text-center">Terminar {{$proxima->nombre}} {{$proxima->fecha}}
                                        - {{$proxima->hora}}</h2>


                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <p>&nbsp;</p>

                                <form class="" action="{{url('/terminar-orden')}}" method="post">
                                    {!! csrf_field() !!}
                                    {{ method_field('POST') }}

                                    <input type="hidden" name="item_id" value="{{$proxima->reservacionId}}"/>
                                    <input type="hidden" name="tipo" value="{{$proxima->tipo}}"/>
                                    <button class="btn btn-primary btn-lg" name="button" type="submit">
                                        Terminar
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal contraseña -->
    <div class="modal fade" id="invitado{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;padding-top: 5px">
                        <h4>AÑADIR PARTICIPANTE</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <b>Clase</b>:{{$proxima->nombre}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Coach</b>:{{$user->name}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Cliente</b>:{{$proxima->direccion}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Fecha</b>:{{$proxima->fecha}}</b>
                            </div>
                        </div>
                        <br/>
                        <div class="row buttons-select">
                            <div class="col-md-4 col-md-offset-2">
                                <button class="btn btn-success add-person" type="submit"
                                        style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                    AÑADIR ADULTO
                                </button>
                            </div>
                            <div class="col-md-4 ">
                                <button class="btn btn-success add-child" type="submit"
                                        style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                    AÑADIR NIÑO
                                </button>
                            </div>
                        </div>
                        <div class="add-child-form">
                            <form method="POST" action="/crear-invitado">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="text" class="form-control" name="nombre"
                                               placeholder="Nombre" required>
                                        <input type="hidden" class="form-control" name="email"
                                               placeholder="Email" value=""/>
                                        <input type="hidden" class="form-control" name="telefono"
                                               placeholder="Teléfono" value=""/>
                                        <input type="hidden" class="form-control" name="genero" required value=""/>
                                        <input type="hidden" name="reservacion_id" value="{{$proxima->id}}"
                                               placeholder="nombres" required/>
                                        <button class="btn btn-success" type="submit"
                                                style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                            Añadir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="add-adult-form-1">
                            <form method="POST" action="#" class="add-adult-form">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="text" class="form-control" name="telefono"
                                               placeholder="Teléfono" required/>
                                        <button class="btn btn-success" type="submit"
                                                style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                            Añadir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="add-adult-form-2">
                            <form method="POST" action="/crear-invitado">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="text" class="form-control add-adult-form-nombre" name="nombre"
                                               placeholder="Nombre" required>
                                        <input type="email" class="form-control add-adult-form-email" name="email"
                                               placeholder="Email" required>
                                        <input type="password" class="form-control add-adult-form-password"
                                               name="password"
                                               placeholder="Contraseña">
                                        <input type="tel" class="form-control add-adult-form-telefono" name="telefono"
                                               placeholder="Teléfono" required>
                                        <select class="form-control  add-adult-form-genero" name="genero" required>
                                            <option value="">Genero</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                        <input type="hidden" name="reservacion_id" value="{{$proxima->id}}"
                                               placeholder="nombres" required/>
                                        <button class="btn btn-success" type="submit"
                                                style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                            Añadir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal contraseña -->
    </div>

    <div class="modal fade" id="proximas{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="" action="{{url('/terminar-orden')}}" method="post">
                    {!! csrf_field() !!}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                    src="{{url('/images/cross.svg')}}" alt=""></button>
                        <div class="container-bootstrap" style="width: 100%;padding-top: 50px">
                            <div class="row">
                                <div class="col-md-4">
                                    <b style="text-transform: capitalize">{{$proxima->nombre}}</b>
                                </div>
                                <div class="col-md-2">
                                    <p>{{$proxima->direccion}}</p>
                                </div>
                                <div class="col-md-2">
                                    <p>{{$proxima->lugar}}</p>
                                </div>
                                <div class="col-md-2">
                                    <p>{{$proxima->hora}}</p>
                                </div>
                                <div class="col-md-2">

                                    <input type="hidden" name="item_id" value="{{$proxima->reservacionId}}"/>
                                    <input type="hidden" name="tipo" value="{{$proxima->tipo}}"/>
                                    <button class="btn btn-success" type="submit"
                                            style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                        Terminar
                                    </button>

                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>LISTA DE ASISTENCIA</p>
                                    <br>
                                    <div class="asistentes-scroll">
                                        @foreach($proxima->asistentes as $asistente)
                                            @if($asistente->estado=='COMENZADA' && !$asistente->reserva)
                                                <label class="cool-check">
                                                    <span>{{$asistente->usuario->name}}</span>
                                                    <input type="checkbox" name='reservations[]'
                                                           value="{{$asistente->id}}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            @endif
                                        @endforeach
                                        @foreach($proxima->invitados as $invitado)
                                            <label class="cool-check">
                                                <span>{{$invitado->nombre}}</span>
                                                <input type="checkbox" checked="" disabled>
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                        @foreach($proxima->asistentes as $asistente)
                                            @if($asistente->estado=='COMENZADA' && $asistente->reserva)
                                                <label class="cool-check">
                                                    <span>{{$asistente->usuario->name}}</span>
                                                    <input type="checkbox" checked="" disabled>
                                                    <span class="checkmark"></span>
                                                </label>
                                            @endif
                                        @endforeach
                                        <br/>
                                    </div>
                                    <a class="btn btn-success agregar-invitado-btn"
                                       data-id="{{$proxima->id}}"
                                       style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                                        Añadir
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p>PLAN DE LA CLASE</p>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            Fase Inicial
                                        </div>
                                        <div class="col-md-3">
                                            {{$proxima->plan['minutosinicio']}}
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$proxima->plan['inicio']}}</p>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            Fase medular
                                        </div>
                                        <div class="col-md-3">
                                            {{$proxima->plan['minutosmedular']}}
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$proxima->plan['medular']}}</p>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-md-3">
                                            Fase Final
                                        </div>
                                        <div class="col-md-3">
                                            {{$proxima->plan['minutosfinal']}}
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$proxima->plan['final']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <p>Mensajes</p>
                                <div class="container-bootstrap" style="width: 100%;padding-top: 50px">
                                    <div class="row">
										<?php
										$mensajes = \App\Mensaje::with( 'user' )->where( 'reservacion_id', $proxima->id )->get();
										?>
                                        @if(count($mensajes)>0)
                                            <div class="col-md-12" style="height: 100px;overflow-y: scroll">
                                                @foreach($mensajes as $mensaje)
                                                    <b>{{$mensaje->created_at}}</b>
                                                    <b>Usuario: {{$mensaje->user->name}}</b>
                                                    <br/>
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
                                </div>
                            </div>

                        </div>
                    </div><!-- /.modal-content -->
                </form>

            </div><!-- /.modal-dialog -->

        </div><!-- /.modal contraseña -->

    </div>
    <div class="modal fade" id="mensajes{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <h4>MENSAJES
                        <span style="color: #cdcdcd">{!! $proxima->nombre !!}</span>
                    </h4>
                    <div class="container-bootstrap" style="width: 100%;padding-top: 50px">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Clase</b>:{{$proxima->nombre}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Coach</b>:{{$user->name}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Cliente</b>:{{$proxima->direccion}}</b>
                            </div>
                            <div class="col-md-3">
                                <b>Fecha</b>:{{$proxima->fecha}}</b>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
							<?php
							$mensajes = \App\Mensaje::where( 'reservacion_id', $proxima->id )->get();
							?>
                            @if(count($mensajes)>0)
                                <div class="col-md-12" style="height: 200px;overflow-y: scroll">
                                    @foreach($mensajes as $mensaje)
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
                    </div>
                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal contraseña -->
    </div>


@endforeach
<script type="application/javascript">
    $('.agregar-invitado-btn').click(function () {
        var id = $(this).attr("data-id");
        $('#proximas' + id).modal('hide');
        setTimeout(function () {
            $('#invitado' + id).modal('show');
        }, 500)
        //
    })
</script>