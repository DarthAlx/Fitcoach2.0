<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('admin.reports.pdf')
</head>
<body>
<div class="container">
    @include('admin.reports.header')
    <h2>ESTATUS DE CLASES</h2>
    <div class="info">
        <p><span class="info-title">Fecha</span>
            {{$now->toDateTimeString()}}
        </p>
    </div>
    <b>TOTAL :</b>
    <table style="width:100%">
            <tr>
                <td width="50%" class="orange">Clases disponibles</td>
                <td width="50%">{{$response->classesAvailable}}</td>
            </tr>
    </table>
    <b>POR VENCER EN LOS PRÓXIMOS :</b>
    <table style="width:100%">
        <tr>
            <td width="50%" class="orange">7 DIAS</td>
            <td width="50%">{{$response->expiracionIn7}}</td>
        </tr>
        <tr>
            <td width="50%" class="orange">14 DIAS</td>
            <td width="50%">{{$response->expiracionIn14}}</td>
        </tr>
        <tr>
            <td width="50%" class="orange">21 DIAS</td>
            <td width="50%">{{$response->expiracionIn21}}</td>
        </tr>
    </table>
    <b>VENCIDAS :</b>
    <table style="width:100%">
        <tr>
            <td width="50%" class="orange">En el Mes</td>
            <td width="50%">{{$response->expiredInTheMonth}}</td>
        </tr>
        <tr>
            <td width="50%" class="orange">Histórico</td>
            <td width="50%">{{$response->expiredTotal}}</td>
        </tr>
    </table>
    <p>Creado el : {{$now->toDateTimeString()}}</p>
</div>
</body>
</html>