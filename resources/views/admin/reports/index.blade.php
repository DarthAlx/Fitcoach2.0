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
                        <div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">REPORTES</div>
                    </div>
                </div>
                <br/>
                {!! Form::open(['url' => '/crear-reporte']) !!}
                <div class="row">
                    <div class="col-lg-4">
                        <select class="form-control" name="report_type" id="report_type" required>
                            <option value="" selected hidden>Seleccione</option>
                            <option value="1">Clientes con clases por vencer</option>
                            <option value="2">Popularidad individual de clases</option>
                            <option value="3">Popularidad general de clases</option>
                            <option value="4">Estatus de clases disponibles</option>
                            <option value="5">Uso de cupones</option>
                            <option value="6">Aforos detallados en Condominio</option>
                            <option value="7">Aforos Generales en condominio</option>
                            <option value="8">Cliente por clase</option>
                            <option value="9">Detalle de Clase COACH</option>
                            <option value="10">Detalle Ventas en Condominio</option>
                            <option value="11">Estado de cuenta cliente</option>
                            <option value="12">Estado de cuenta coach</option>
                            <option value="13">Reservaciones por cliente</option>
                            <option value="14">Reservaciones por condominio</option>
                            <option value="15">Ventas por periodo</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="desde" placeholder="Desde..." value="">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="hasta" placeholder="Hasta..." value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <select name="condominio_id" class="form-control" required id="condominio_id"
                                style="display:none ">
                            <option selected hidden>Seleccione...</option>
                            @foreach($condominios as $condominio)
                                <option value="{{$condominio->id}}">{!! $condominio->identificador !!}</option>
                            @endforeach
                        </select>
                        <select name="clase_id" class="form-control" required id="clase_id" style="display:none ">
                            <option selected hidden>Seleccione...</option>
                            @foreach($clases as $clase)
                                <option value="{{$clase->id}}">{!! $clase->nombre !!}</option>
                            @endforeach
                        </select>
                        <select name="coach_id" class="form-control" required id="coach_id" style="display:none ">
                            <option selected hidden>Seleccione un coach...</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{!! $user->name !!}</option>
                            @endforeach
                        </select>
                        <select name="type_id" class="form-control" id="type_id" style="display:none " required>
                            <option selected hidden>Seleccione un tipo de clase...</option>
                            @foreach($types as $type)
                                <option value="{{$type}}">{!! $type!!}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control " name="client_id" id="client_id"
                               placeholder="Correo cliente" style="display:none " >
                    </div>
                    <div class="col-sm-4">
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>L</span>
                            <input type="checkbox" name="lunes">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>M</span>
                            <input type="checkbox" name="martes">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>M</span>
                            <input type="checkbox" name="miercoles">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>J</span>
                            <input type="checkbox" name="jueves">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>V</span>
                            <input type="checkbox" name="viernes">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>S</span>
                            <input type="checkbox" name="sabado">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                        <label class="cool-check" style="display: inline-block;margin-right: 15px;">
                            <span>D</span>
                            <input type="checkbox" name="domingo">
                            <span class="checkmark" style="margin-top: -1px;margin-left: 10px;"></span>
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4" style="padding-top: 3px">
                                        De
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="hora_inicio" class="form-control mitimepicker"
                                               placeholder="Hora"/>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-4" style="padding-top: 3px">
                                    A
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="hora_fin" class="form-control mitimepicker"
                                           placeholder="Hora"/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <button class="btn btn-success" type="submit">Generar</button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <p>&nbsp;</p>

        </div>
    </section>

