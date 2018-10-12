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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @if(!$proxima->plan)

                                <label>Fase inicial</label>
                                <textarea name="inicio" class="form-control" required></textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosinicio" required>

                                <label>Fase medular</label>
                                <textarea name="medular" class="form-control" required></textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosmedular" required>

                                <label>Fase final</label>
                                <textarea name="final" class="form-control" required></textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosfinal" required>

                                <label>Comentarios</label>
                                <textarea name="comentarios" class="form-control" required></textarea>
                                <input type="hidden" name="reservacion_id" value="{{$proxima->id}}">
                            @else
                                {{$proxima->plan}}

                                <label>Fase inicial</label>
                                <textarea name="inicio" class="form-control"
                                          required>{{$proxima->plan->inicio}}</textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosinicio"
                                       value="{{$proxima->plan->minutosinicio}}" required>

                                <label>Fase medular</label>
                                <textarea name="medular" class="form-control"
                                          required>{{$proxima->plan->medular}}</textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosmedular"
                                       value="{{$proxima->plan->minutosmedular}}" required>

                                <label>Fase final</label>
                                <textarea name="final" class="form-control"
                                          required>{{$proxima->plan->final}}</textarea>
                                <label>Minutos</label>
                                <input type="number" class="form-control" name="minutosfinal"
                                       value="{{$proxima->plan->minutosfinal}}" required>

                                <label>Comentarios</label>
                                <textarea name="comentarios" class="form-control"
                                          required>{{$proxima->plan->comentarios}}</textarea>
                                <input type="hidden" name="reservacion_id" value="{{$proxima->id}}">
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

    {{--<div class="modal fade" id="telefono{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;">
                        <h4>Contacto telefónico</h4>
                        <h2 class="text-center">Teléfono: {{ $proxima->user->tel }}</h2>
                        <div class="text-center">
                            <a href="tel:{{ $proxima->user->tel }}" class="btn btn-primary">Llamar</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>--}}

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
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="revision" value="{{$proxima->id}}">
                                    <input type="text" id="taforo{{$proxima->id}}" name="aforo" class="form-control"
                                           placeholder="Aforo" style="display:none; width: 30%" required><br>

                                    <button type="submit" id="tbotonmandar{{$proxima->id}}"
                                            class="btn btn-primary btn-lg" name="button" style="display:none;">¿Mandar a
                                        revisión?
                                    </button>
                                </form>
                                <button class="btn btn-primary btn-lg" id="tbotonmandar2{{$proxima->id}}" name="button"
                                        onclick="javascript: document.getElementById('tbotonmandar2{{$proxima->id}}').style.display='none'; document.getElementById('tbotonmandar{{$proxima->id}}').style.display='inline-block'; document.getElementById('taforo{{$proxima->id}}').style.display='inline-block'; ">
                                    Terminar
                                </button>


                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal contraseña -->

    <div class="modal fade" id="proximas{{$proxima->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div class="container-bootstrap" style="width: 100%;">
                        <div class="row">
                            <div class="col-sm-4 sidebar">
                                <div class="text-center">
                                    <h1>{{$proxima->nombre}}</h1>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="title ">
                                    {{Ucfirst($proxima->tipo)}}
                                </div>
                                <div class="gotham2">
                                    <h2>Fecha: {{$proxima->fecha}}</h2>
                                    <h2>Hora: {{$proxima->hora}}</h2>
                                    <h2>Lugar: {{ $proxima->lugar }}</h2>
                                   {{-- <h2>Teléfono: {{ $proxima->user->tel }}</h2>--}}
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <p>&nbsp;</p>

                                <form class="" action="{{url('/terminar-orden')}}" method="post">
                                    {!! csrf_field() !!}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="revision" value="{{$proxima->id}}">
                                    <input type="text" id="aforo{{$proxima->id}}" name="aforo" class="form-control"
                                           placeholder="Aforo" style="display:none; width: 30%" required><br>

                                    <button type="submit" id="botonmandar{{$proxima->id}}"
                                            class="btn btn-primary btn-lg" name="button" style="display:none;">¿Mandar a
                                        revisión?
                                    </button>
                                </form>
                                <button class="btn btn-primary btn-lg" id="botonmandar2{{$proxima->id}}" name="button"
                                        onclick="javascript: document.getElementById('botonmandar2{{$proxima->id}}').style.display='none'; document.getElementById('botonmandar{{$proxima->id}}').style.display='inline-block'; document.getElementById('aforo{{$proxima->id}}').style.display='inline-block'; ">
                                    Terminar
                                </button>


                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal contraseña -->


@endforeach
