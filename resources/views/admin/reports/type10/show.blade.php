<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>DETALLE DE RESERVACIONES</h2>
    <p style="text-align: center">{!! $condominio->identificador !!}</p>
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
            <th width="33%">Grupos Disponibles</th>
            <th width="33%">Clases Impartidas</th>
            <th width="33%">Reservaciones</th>
        </tr>
        <tr>
            <td>{{$groups!=null?$groups->total:0}}</td>
            <td>{{$clases!=null?$clases->total:0}}</td>
            <td>{{$reservaciones!=null?$reservaciones->total:0}}</td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td width="10%">#</td>
            <td width="30%">Grupo</td>
            <td width="30%">Horario</td>
            <td width="30%">Reservaciones</td>
        </tr>
        @foreach($details as $index=>$detail)
            <tr>
                <td>{{$index}}</td>
                <td>{{$detail->nombre}}</td>
                <td>{{$detail->hora}}</td>
                <td>{{$detail->total}}</td>
            </tr>
        @endforeach

    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>