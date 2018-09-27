@foreach ($condominio->eventos as $evento)
    <div class="modal fade" id="evento{{$evento->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{url('/images/cross.svg')}}" alt=""></button>
                    <div>
                        <h4>Evento</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <b>Nombre :</b>
                                {!!  $evento->nombre !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Fecha :</b>
                                {!!  $evento->fecha !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Hora :</b>
                                {!!  $evento->hora !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Precio :</b>
                                {!!  $evento->precio !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Cupo :</b>
                                {!!  $evento->cupo !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Dirección :</b>
                                {!!  $evento->direccionevento !!}
                            </div>
                            <div class="col-lg-12">
                                <b>Descripción :</b>
                                {!!  $evento->descripcion !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal detalles user -->
@endforeach
