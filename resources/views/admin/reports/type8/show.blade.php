<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>DETALLE DE CLIENTES</h2>
    <p style="text-align: center">{!! $clase->nombre !!}</p>
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
            <th width="5%">Total</th>
            <th width="35%">Nombre</th>
            <th width="35%">Mail</th>
            <th width="20%">Celular</th>
        </tr>
        @foreach($data as $index=>$item)
            <tr>
                <td>{{$index}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->tel}}</td>
            </tr>
        @endforeach
    </table>
    <div>
        <p>Creado el : {{$now->toDateTimeString()}}</p>
    </div>
</div>
</body>
</html>