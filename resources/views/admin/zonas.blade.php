@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap">

  <div class="topclear">
    &nbsp;
  </div>

    <div class="row profile">
      <div class="col-sm-12">
        @include('holders.notificaciones')
      </div>

		<div class="col-md-12">
            <div class="profile-content">
              <!-- zonas -->
              <h2>Zonas</h2>
              @if (!$zonas->isEmpty())
                   <div class="panel-group" id="zonas" role="tablist" aria-multiselectable="true">
                     @foreach ($zonas as $zona)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $zona->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#zonas" href="#collapse{{ $zona->id }}" aria-expanded="false" aria-controls="collapse{{ $zona->id }}">
                             <a role="button">
                                   {{ Ucfirst($zona->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $zona->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $zona->id }}">
                           <div class="panel-body">
                             <div class="zona">
                               <div class="editar">
                                 <div class="col-md-12">

                                    <form id="signupform" class="form-horizontal" role="form" action="{{ url('/actualizar-zona') }}/{{ $zona->id }}" method="post"  enctype="multipart/form-data">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Identificador</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $zona->identificador }}" name="identificador" id="identificador{{ $zona->id }}" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                 													<div class="col-sm-12 text-right">
                 														<input class="btn btn-primary" type="submit" value="Actualizar"> &nbsp;

                                            <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $zona->id }}').click();">Borrar</a>

                 													</div>
                 												</div>



                                    </form>
                                    <form style="display: none;" action="{{ url('/eliminar-zona') }}/{{ $zona->id }}" method="post">
                                      {!! csrf_field() !!}
                                      <input type="submit" id="botoneliminar{{ $zona->id }}">
                                    </form>

                          </div>
                               </div>

                             </div>
                           </div>
                         </div>
                       </div>

                     @endforeach


                   </div>

           @else
             <p>No hay zonas</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#zonas" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar zona
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo" >
               <div class="panel-body">
                 <div class="zona">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-zona') }}" method="post"  enctype="multipart/form-data">


                       <div class="form-group">
                           <label class="col-sm-3 control-label">Identificador</label>
                           <div class="col-sm-9">
                               <input type="text" class="form-control" value="{{ old('identificador') }}" name="identificador" required >
                           </div>
                       </div>
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <div class="col-sm-12 text-right">
                              <input class="btn btn-success" type="submit" value="Guardar" id="botonguardarNuevo">
                            </div>
                          </div>
                    </form>
                  </div>
              </div>
                   </div>

                 </div>
               </div>
             </div>
           </div>

           <!--termina zonas -->


            </div>
		</div>
	</div>
</div>

@endsection
