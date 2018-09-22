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
                <p style="text-align: center;color: #cdcdcd;margin-bottom: 15px;">Detalle de Clase COACH</p>
                <form method="POST" action="/reportes/8">
                    {!! csrf_field() !!}
                    <div class="row" style="height: 300px">
                        <div class="col-sm-4">
                            <input type="text" class="form-control datepicker" name="from" placeholder="Desde..." value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control datepicker" name="to" placeholder="Hasta..." value="">
                        </div>
                        <div class="col-sm-4">
                            <select name="coach_id" class="form-control" required>
                                <option selected hidden>Seleccione un coach...</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{!! $user->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <div class="dropdown">
                                <button class="btn btn-success" type="submit">Generar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <p>&nbsp;</p>

        </div>
    </section>

