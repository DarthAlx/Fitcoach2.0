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
    @foreach($user->nomina() as $pago)
        @if($pago!=null)
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
                        ${{$count-$pago->monto}}
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
                        ${{$count-$pago->monto}}
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
                        ${{$count-($pago->monto+$pago->iva)}}
                    </td>
                </tr>
            @endif

        @endif


    @endforeach

    </tbody>
</table>

