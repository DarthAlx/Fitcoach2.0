<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>USO DE CUPONES</h2>
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
            <th width="10%">#</th>
            <th width="33%">Cupón</th>
            <th width="33%">Nombre</th>
            <th width="33%">Valor</th>
            <th width="33%">Usos</th>
            <th width="33%">Total</th>
        </tr>
        @foreach($data as $index=>$item)
            <tr>
                <td>{{$index}}</td>
                <td>{{$item->codigo}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{sprintf('%s', number_format(($item->monto),2))}} MXN</td>
                <td>{{$item->usos}}</td>
                <td>{{sprintf('%s', number_format(($item->monto*$item->usos), 2))}} MXN</td>
            </tr>
        @endforeach
    </table>
    <p>Creado el : {{$now->toDateTimeString()}}</p>
</div>
</body>
</html>