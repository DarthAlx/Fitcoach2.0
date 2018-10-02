<div class="modal fade" id="crear-evento" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                            src="{{url('/images/cross.svg')}}" alt=""></button>
                <div>
                    <h4>Agregar evento</h4>
                    <form action="{{ url('/admin-condominio/agregar-evento') }}" method="post"
                          enctype="multipart/form-data">
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
