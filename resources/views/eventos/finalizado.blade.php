@extends('plantilla')
@section('pagecontent')
    <section class="container-bootstrap">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">
                <h1 class="gotham2 text-center" style="padding: 15vh 0;">
                    ¡Gracias por tu compra! <br><br><br> <a class="btn btn-success" style="width: 65%; margin: 0 auto;"
                                                            href="{{url('/perfil')}}">Ir a mi perfil</a></h1>
            </div>
        </div>
        <script type="text/javascript">
            fbq('track', 'Purchase', {value: '{!! $evento->precio !!}', currency: 'MXN'});
        </script>
    </section>
@endsection
