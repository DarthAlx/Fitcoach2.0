<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>DETALLE DE CLASES</h2>
    <p style="text-align: center">{!! $user->name !!}</p>
    <div class="info">
        <p><span class="info-title">Periodo</span> {{$startDate->toDateString()}} al {{$endDate->toDateString()}}</p>
    </div>
    <table style="width:100%">
        <tr class="table-header">
            <th width="20%">Fecha</th>
            <th width="10%">Clase</th>
            <th width="20%">Tipo</th>
            <th width="20%">Aforo</th>
            <th width="20%">Status</th>
            <th width="20%">Abonado</th>
        </tr>
        @foreach($data as $item)
            <tr>
                <td>{{$item->fecha}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->tipo}}</td>
                <td>{{$item->aforo}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->realizado}}</td>
            </tr>
        @endforeach
    </table>
    <div class="notes">
        <b>Notas</b>
        <p>Se acomoda la tabla por fecha..</p>
    </div>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>