<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>RESERVACIONES POR CONDOMINIO</h2>
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
            <th width="20%">Condominio</th>
            <th width="20%">Grupos Disp.</th>
            <th width="20%">Clases</th>
            <th width="20%">Reservaciones</th>
            <th width="20%">Promedio</th>
        </tr>
        <tr>
            <td>{{$condominio->identificador}}</td>
            <td>{{$grupos}}</td>
            <td>{{$horarios}}</td>
            <td>{{$reservaciones}}</td>
            <td>{{$promedio}}</td>
        </tr>
    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>