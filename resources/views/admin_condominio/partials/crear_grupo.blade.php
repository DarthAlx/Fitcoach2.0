<div class="modal fade" id="crear-grupo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                            src="{{url('/images/cross.svg')}}" alt=""></button>
                <div>
                    <h4>Agregar grupo <span style="color: #cdcdcd">{!! $condominio->identificador !!}</span></h4>
                    <form action="{{ url('/admin-condominio/agregar-grupo') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre"
                               value="{{ old('nombre') }}" required>

                        <input type="hidden" name="condominio_id" value="{!! $condominio->id !!}">

                        <select class="form-control" name="room_id" id="room_idNuevo" required>
                            <option value="">Selecciona un room</option>
                            @foreach ($rooms2 as $room)
                                <option value="{{ $room->id }}">{{ $room->nombre }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="user_id" id="coachNuevo" required>
                            <option value="">Selecciona un coach</option>
                            @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="clase_id" id="clases_idNuevo" required>
                            <option value="">Selecciona una clase</option>
                            @foreach ($clases as $clase)
                                <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="audiencia" id="audiencia" required>
                            <option value="">Selecciona una audiencia</option>
                            <option value="Todos">Todos</option>
                            <option value="Adultos">Adultos</option>
                            <option value="Adolescentes">Adolescentes</option>
                            <option value="Niños">Niños</option>
                            <option value="Bebés">Bebés</option>
                        </select>
                        <input type="number" id="cupo" class="form-control" name="cupo" placeholder="Cupo"
                               value="{{ old('cupo') }}" required>

                        <input type="number" id="tokens" class="form-control" name="tokens" placeholder="Tokens"
                               value="{{ old('tokens') }}" required>

                        <textarea name="descripcion" class="form-control" placeholder="Descripción"
                                  rows="10"></textarea>


                        <button class="btn btn-success" type="submit"
                                style="color: #fff !important; background-color: #D58628 !important; border-color: rgba(213, 134, 40, 0.64) !important;">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal detalles user -->
