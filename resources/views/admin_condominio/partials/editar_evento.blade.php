@if ($eventos)
    @foreach ($eventos as $evento)
        <div class="modal fade" id="editar-evento{{$evento->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                    src="{{url('/images/cross.svg')}}" alt=""></button>
                        <div>
                            <h4>Editar evento</h4>
                            <form action="{{ url('/admin-condominio/actualizar-evento') }}" method="post"
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
    @endforeach
@endif
