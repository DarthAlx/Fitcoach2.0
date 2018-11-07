<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>CLASES RESERVADAS POR CLIENTE</h2>
    <p style="text-align: center">{!! $user->name !!}</p>
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
            <th width="5%">#</th>
            <th width="15%">Fecha</th>
            <th width="20%">ID</th>
            <th width="20%">Clase</th>
            <th width="20%">Tipo</th>
            <th width="20%">Estatus</th>
        </tr>
        @foreach($data1 as $index=>$item)
            <tr>
                <td>{{$index}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->tipo}}</td>
                <td>{{$item->estado}}</td>
            </tr>
        @endforeach
        @foreach($data2 as $index=>$item)
            <tr>
                <td>{{$index}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->tipo}}</td>
                <td>{{$item->estado}}</td>
            </tr>
        @endforeach
    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>