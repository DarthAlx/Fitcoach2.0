<table class=" table table-bordered dynamic-table4">
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
    <?php
    $count = 0;
    ?>
    @foreach($user->nomina() as $pago)
        @if($pago!=null)

            @if($pago->metodo==null)
                <tr>
                    <td>
						<?php
						if ($pago->reservacion!=null ) {
							echo \Carbon\Carbon::parse( $pago->reservacion->fecha . ' ' . $pago->reservacion->hora )->toDateTimeString();
						}
						$count += $pago->abono;
						?>
                    </td>
                    <td>
                        @if($pago->reservacion!=null)
                            {{$pago->reservacion->horario->clase->nombre}} - {{$pago->reservacion->id}}
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>
                        $ {{$pago->abono}}
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        ${{$count}}
                    </td>
                </tr>
            @elseif($pago->metodo=='Asimilados')
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
                        ${{$count-$pago->monto}}
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
                        ${{$count-$pago->monto}}
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
                        ${{$count-($pago->monto+$pago->iva)}}
                    </td>
                </tr>
            @endif

        @endif


    @endforeach

    </tbody>
</table>

