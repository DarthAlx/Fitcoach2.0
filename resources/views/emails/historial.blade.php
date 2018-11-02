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
                <h2>Historial de pagos de {{$user->name}}</h2>
            </div>
        </td>
        <td>

        </td>
    </tr>

    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="border" width="100%" cellspacing="0" cellpadding="6">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Entradas</th>
                    <th>Salidas</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->nomina() as $pago)
                    <?php
                    $count = 0;
                    ?>
                    @foreach($pago->abonos as $abono)
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($abono->created_at)->toDateTimeString();
                                $count += $abono->abono;
                                ?>
                            </td>
                            <td>
                                @if($abono->reservacion!=null)
                                    {{$abono->reservacion->horario->clase->nombre}} - {{$abono->reservacion->id}}
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                $ {{$abono->abono}}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$count}}
                            </td>
                        </tr>
                    @endforeach
                    @if($pago->metodo=='Asimilados')
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($pago->created_at)->toDateTimeString();
                                ?>
                            </td>
                            <td>
                                <span>Deduccion por asimilados</span>
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$pago->deducciones}}
                            </td>
                            <td>
                                ${{$count-$pago->deducciones}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($pago->created_at)->toDateTimeString();
                                ?>
                            </td>
                            <td>
                                <span>Pago a cuenta propia - {{$pago->id}}</span>
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$pago->monto}}
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                    @elseif($pago->metodo=='Efectivo')
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($pago->created_at)->toDateTimeString();
                                ?>
                            </td>
                            <td>
                                <span>Pago en efectivo</span>
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$pago->monto}}
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                    @elseif($pago->metodo=='Transferencia')
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($pago->created_at)->toDateTimeString();
                                ?>
                            </td>
                            <td>
                                <span>Iva por factura</span>
                            </td>
                            <td>
                                ${{$pago->iva}}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$count+$pago->iva}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                echo \Carbon\Carbon::parse($pago->created_at)->toDateTimeString();
                                ?>
                            </td>
                            <td>
                                <span>Pago a cuenta propia - {{$pago->id}}</span>
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                ${{$pago->monto+$pago->iva}}
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                    @endif


                @endforeach

                </tbody>
            </table>


        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
