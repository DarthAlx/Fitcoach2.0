<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>AFOROS DETALLADOS POR GRUPO</h2>
    <p style="text-align: center">{!! $condominio->identificador !!}</p>
    <div class="info">
        <p><span class="info-title">Periodo</span> {{$startDate->toDateString()}} al {{$endDate->toDateString()}}</p>
    </div>
    @foreach($data as $item)
        <table style="width:100%">
            <tr class="table-header">
                <th width="20%">Grupo</th>
                <th width="20%">Horario</th>
                <th width="20%">Coach</th>
                <th width="20%">Num. de clases</th>
                <th width="20%">Aforo Promedio</th>
            </tr>
            <tr>
                <td>{{$item->nombre}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->total}}</td>
                <td>{{sprintf('%s', number_format(($item->promedio), 0))}}</td>
                <td></td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td width="10%"><b>#</b></td>
                <td width="30%"><b>Fecha</b></td>
                <td width="30%"><b>Reservadas</b></td>
                <td width="30%"><b>Aforo</b></td>
            </tr>
            @foreach($item->horarios as $index=>$horario)
                <tr>
                    <td>{{$index}}</td>
                    <td>{{$horario->fecha}}</td>
                    <td>{{$horario->ocupados}}</td>
                    <td>{{$horario->cupo}}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
    <div class="notes">
        <b>Notas</b>
        <p>El aforo promedio es la suma de los aforos registrado por el coach entre el número de clases. </p>
    </div>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>