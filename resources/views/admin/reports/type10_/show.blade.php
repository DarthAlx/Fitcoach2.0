<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>CLIENTES CON CLASES POR VENCER</h2>
    <div class="info">
        <p><span class="info-title">Hasta</span> {{$date->toDateString()}}</p>
    </div>
    <table style="width:100%">
        <tr class="table-header">
            <th width="5%">#</th>
            <th width="15%">Clases</th>
            <th width="20%">Vencimiento</th>
            <th width="20%">Nombre</th>
            <th width="20%">Mail</th>
            <th width="20%">Celular</th>
        </tr>
        @foreach($data as $index=>$item)
            <tr>
                <td>{{$index}}</td>
                <td>{{$item->disponibles}}</td>
                <td>{{$item->expiracion}}</td>
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