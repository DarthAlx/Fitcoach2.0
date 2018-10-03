@if (isset($eventos))
    @foreach ($eventos as $evento)
        <div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body  evento">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                                src="{{url('/images/cross.svg')}}" alt=""></button>
                                </div>
                            </div>
                        </div>

                        <div class="container-bootstrap" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 sidebar">
                                    <div class="row">
                                        <div class="col-sm-3	hidden-xs hidden-sm">
                                            <img src="{{ url('uploads/clases') }}/{{ $evento->imagen }}"
                                                 alt="{{$evento->nombre}}" class="img-responsive hidden-xs">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="title" style="    line-height: 1;">
                                                {{$evento->nombre}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 sidebar hidden-xs hidden-sm">
                                    <div class="title pull-right" style="    line-height: 1;">
                                        ${{$evento->precio}}<br>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <a href="{{url('eventos/comprar?eventoId='.$evento->id)}}" type="submit" class="btn btn-success btn-lg" name="" >
                                                Reservar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <div class="row">

                                <div class="col-sm-8 sidebar" style="    border-right: 1px solid #ccc;">
                                    <div class="gotham2 textoevento">
                                        <p><span>Fecha:</span> {{$evento->fecha}}</p>
                                        <p><span>Hora:</span> {{$evento->hora}}</p>

                                        <p>
                                            <span>Disponibilidad:</span> {{intval($evento->cupo)-intval($evento->ocupados)}}
                                            personas
                                        </p>
                                        <p>&nbsp;</p>

                                        <p style="line-height: 1;"><span>Ubicación:</span><br> <span
                                                    class="menor">{!!$evento->direccionevento!!}</span></p>

                                    </div>
                                </div>
                                <div class="col-sm-4 sidebar">
                                    <div class="gotham2 textoevento">
                                        <p style="line-height: 1;"><span>Descripción:</span> <br><span
                                                    class="menor">{!!$evento->descripcion!!}</span></p>
                                    </div>
                                </div>


                                <div class="col-xs-12 sidebar visible-xs visible-sm">
                                    <div class="title pull-right">
                                        ${{$evento->precio}}
                                    </div>

                                    <form action="{{url('carrito')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="evento_id" value="{{$evento->id}}">
                                        <input type="hidden" name="tipo" value="Evento">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-4">
                                                <input type="submit" class="btn btn-success btn-lg" name=""
                                                       value="Reservar">
                                            </div>
                                        </div>
                                    </form>


                                </div>


                            </div>

                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal contraseña -->

    @endforeach

@endif
