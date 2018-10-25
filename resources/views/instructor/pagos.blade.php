<div class="list-group">
    <div class="list-group-item row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-2">
           <b>CANTIDAD DEPOSITADA</b>
        </div>
    </div>
	<?php
	$pagos = $user->pagos;

	if (! $pagos->isEmpty()) {
	date_default_timezone_set( 'America/Mexico_City' );

	foreach ($pagos as $pago) {
	?>
	<?php setlocale( LC_TIME, "es_MX" ); ?>
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
                <b>Iva :</b> $ {{$pago->monto*0.16}}
            @endif

        </div>
        <div class="col-sm-2">
            @if($pago->metodo=='Asimilados')
                <span>$ {{$pago->monto-$pago->deducciones}}</span>
            @elseif($pago->metodo=='Efectivo')
                <span>$ {{$pago->monto}}</span>
            @elseif($pago->metodo=='Transferencia')
                <span>$ {{$pago->monto+$pago->monto*0.16 }}</span>
            @endif
        </div>
    </div>
	<?php
	}
	} else{ ?>
    <p class="text-center">No has recibido ningún pago.</p>
	<?php  }
	?>

</div>