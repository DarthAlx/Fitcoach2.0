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
              <!-- slides -->
              <h2>Slides</h2>
              @if (!$slides->isEmpty())
                   <div class="panel-group" id="slides" role="tablist" aria-multiselectable="true">
                     @foreach ($slides as $slide)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $slide->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#slides" href="#collapse{{ $slide->id }}" aria-expanded="false" aria-controls="collapse{{ $slide->id }}">
                             <a role="button">
                                   Slide {{ Ucfirst($slide->orden) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $slide->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $slide->id }}">
                           <div class="panel-body">
                             <div class="slide">
                               <div class="editar">
                                 <div class="col-md-12">

                                    <form id="signupform" class="form-horizontal" role="form" action="{{ url('/actualizar-slide') }}/{{ $slide->id }}" method="post"  enctype="multipart/form-data">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <div class="form-group">
                  											<label class="col-sm-3 control-label">Imagen (solo si se desea reemplazar)</label>
                  											<div class="col-sm-9">
                  												<input class="form-control" type="file" id="image{{ $slide->id }}" name="image" disabled >
                  											</div>
                  										</div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Caption</label>
                                            <div class="col-sm-9">
                                              <textarea class="form-control ckeditor" name="description" rows="25" id="description{{ $slide->id }}" >{!! $slide->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Orden</label>
                                            <div class="col-sm-9">
                                                <input type="num" class="form-control" value="{{ $slide->order }}" name="order" id="order{{ $slide->id }}" disabled required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                 													<div class="col-sm-12 text-right">
                 														<input class="btn btn-primary" type="submit" value="Actualizar" style="display: none" id="botonguardar{{ $slide->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $slide->id }}" onclick="habilitar({{ $slide->id }})">Editar</a> &nbsp;

                                            <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $slide->id }}').click();">Borrar</a>

                 													</div>
                 												</div>



                                    </form>
                                    <form style="display: none;" action="{{ url('/eliminar-slide') }}/{{ $slide->id }}" method="post">
                                      {!! csrf_field() !!}
                                      <input type="submit" id="botoneliminar{{ $slide->id }}">
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
             <p>No hay slides</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#slides" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar slide
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo" >
               <div class="panel-body">
                 <div class="slide">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-slide') }}" method="post"  enctype="multipart/form-data">

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Imagen</label>
                         <div class="col-sm-9">
                           <input class="form-control" type="file" id="imageNuevo" name="image">
                         </div>
                       </div>
                         <div class="form-group">
                             <label  class="col-sm-3 control-label">Caption</label>
                             <div class="col-sm-9">
                               <textarea class="form-control ckeditor" name="description" rows="25" id="descriptionNuevo">{{ old('description') }}</textarea>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-3 control-label">Orden</label>
                             <div class="col-sm-9">
                                 <input type="num" class="form-control" name="order" value="{{ old('order') }}" id="orderNuevo"required >
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

           <!--termina slides -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('image'+valor).disabled=false;
    document.getElementById('description'+valor).disabled=false;
    document.getElementById('order'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>

@endsection
