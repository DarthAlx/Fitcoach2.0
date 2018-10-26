<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>POPULARIDAD DE CLASES</h2>
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
            <th width="33%">Clase</th>
            <th width="33%">Reservaciones</th>
            <th width="33%">%</th>
        </tr>
        @foreach($data as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>{{$item->total}}</td>
                <td>
                    @if($total>0)
                        {{sprintf('%s', number_format(($item->total/$total)*100, 0))}} %
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>