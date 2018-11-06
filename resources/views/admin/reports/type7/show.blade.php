<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>AFOROS GENERALES</h2>
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
            <th width="20%">Grupo</th>
            <th width="20%">Horario</th>
            <th width="20%">Coach</th>
            <th width="20%">Num. de clases</th>
            <th width="20%">Aforo Promedio</th>
        </tr>
        @foreach($data as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->total}}</td>
                <td>{{sprintf('%s', number_format(($item->promedio), 0))}}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>