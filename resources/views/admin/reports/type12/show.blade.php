<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>ESTADO DE CUENTA</h2>
    <p style="text-align: center">{!! $user->name !!}</p>
    <div class="info">
        <p><span class="info-title">Periodo</span>
            @if($startDate!=null)
                <span>Desde </span>
                {{$startDate->toDateTimeString()}}
            @endif
            @if($endDate!=null)
                <span>Hasta </span>
                {{$endDate->toDateTimeString()}}</p>
        @endif
    </div>
    <table style="width:100%">
        <tr class="table-header">
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Entradas</th>
            <th>Salidas</th>
            <th>Saldo</th>
        </tr>
        <tbody>
        @foreach($pagos as $pago)
            @if($pago!=null)
				<?php
				$count = 0;
				?>
                @foreach($pago->abonos as $abono)
                    <tr>
                        <td>
							<?php
							echo \Carbon\Carbon::parse( $abono->created_at )->toDateTimeString();
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
							echo \Carbon\Carbon::parse( $pago->created_at )->toDateTimeString();
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
							echo \Carbon\Carbon::parse( $pago->created_at )->toDateTimeString();
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
							echo \Carbon\Carbon::parse( $pago->created_at )->toDateTimeString();
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
							echo \Carbon\Carbon::parse( $pago->created_at )->toDateTimeString();
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
							echo \Carbon\Carbon::parse( $pago->created_at )->toDateTimeString();
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

            @endif
        @endforeach

        </tbody>
    </table>

    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>