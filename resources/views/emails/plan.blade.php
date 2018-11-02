<html>
<head>
    <style type="text/css">
        body {
            margin: 18px;
        }

        body, table {
            font: 12px/18px "Lucida Grande", Arial, Verdana, sans-serif;
        }

        table.border {
            font: 11px/18px "Lucida Grande", Arial, Verdana, sans-serif;
        }

        table.border {
            border-right: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        table.border td {
            border-top: 1px solid #eee;
            border-left: 1px solid #eee;
        }

        table span {
            color: #888;
        }
    </style>
    <title>Plan</title>
</head>
<body>
<table class="invoice" width="100%" cellspacing="0" cellpadding="6">
    <tbody>
    <tr>
        <td colspan="2">
            <img src="{{  url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left" style="width:200px;">
        </td>
    </tr>
    <tr>
        <td>
            <div class="pull-right">
                <h2>Plan de clase</h2>
            </div>
        </td>
        <td align="right">
            <div class="pull-right">

            </div>
        </td>
    </tr>
    <tr>
        <td>

            <p>
                <strong>Condominio:</strong>

                {{$condominio->identificador}}<br>

                <strong>Detalles del evento:</strong> <br>

                Fecha:{{$horario->fecha}} {{$horario->hora}}<br>
                Clase:{{$horario->clase->nombre}}<br>
                Coach:{{$horario->user->name}}<br>
                Lugar: {{$horario->grupo->condominio->identificador}}<br>{{$horario->grupo->condominio->direccion}}<br>
                Cupo: {{$horario->cupo}} personas <br>
                Lugares disponibles: {{intval($horario->cupo)-intval($horario->ocupados)}}<br>

                Audiencia: {{$horario->audiencia}}
            </p>
        </td>
        <td align="right"></td>
    </tr>

    <tr>
        <td colspan="2">

            <table class="border" width="100%" cellspacing="0" cellpadding="6">
                <tbody>
                <tr>
                    <td>
                        <b>Objetivos</b>
                        <p>
                            {{$reservacion->plan->objetivos}}
                        </p>
                    </td>
                    <td>
                        <b>Materiales</b>
                        <p>
                            {{$reservacion->plan->materiales}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fase inicial</b>
                        <p>
                            {{$reservacion->plan->inicio}}
                        </p>
                        <p>
                            Minutos {{$reservacion->plan->minutosinicio}}
                        </p>
                    </td>
                    <td>
                        <b>Fase medular</b>
                        <p>
                            {{$reservacion->plan->medular}}
                        </p>
                        <p>
                            Minutos {{$reservacion->plan->medular}}
                        </p>
                    </td>
                    <td>
                        <b>Fase final</b>
                        <p>
                            {{$reservacion->plan->final}}
                        </p>
                        <p>
                            Minutos {{$reservacion->plan->final}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Comentarios</b>
                        <p>
                            {{$reservacion->plan->comentarios}}
                        </p>
                    </td>
                </tr>

                </tbody>
            </table>


        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
