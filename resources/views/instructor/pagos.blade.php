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

        @endif


    @endforeach

    </tbody>
</table>


<?php
/*	$pagos = $user->pagos;

    if (! $pagos->isEmpty()) {
    date_default_timezone_set( 'America/Mexico_City' );

    foreach ($pagos as $pago) {
    */?><!--
	<?php /*setlocale( LC_TIME, "es_MX" ); */?>
        <div class="list-group-item row">
            <div class="col-sm-2">
{{$pago->fecha}}
        </div>
        <div class="col-sm-3">
            <span>{{$pago->referencia}}</span>
        </div>
        <div class="col-sm-2">
            {{$pago->metodo}}
        </div>
        <div class="col-sm-3">
            @if($pago->metodo=='Asimilados')
    <p>
        <b>Monto :</b> $ {{$pago->monto}}<br/>
                    <b>Deducciones :</b> ${{$pago->deducciones}}
            </p>
@elseif($pago->metodo=='Efectivo')
    <b>Monto :</b> $ {{$pago->monto}}
@elseif($pago->metodo=='Transferencia')
    <b>Monto :</b> $ {{$pago->monto}}<br/>
                <b>Iva :</b> $ {{$pago->iva}}
@endif

        </div>
        <div class="col-sm-2">
            @if($pago->metodo=='Asimilados')
    <span>$ {{$pago->monto-$pago->deducciones}}</span>
            @elseif($pago->metodo=='Efectivo')
    <span>$ {{$pago->monto}}</span>
            @elseif($pago->metodo=='Transferencia')
    <span>$ {{$pago->monto+$pago->iva }}</span>
            @endif
        </div>
    </div>
	<?php
/*	}
    } else{ */?>
        <p class="text-center">No has recibido ningún pago.</p>
--><?php /* }
	*/?>

