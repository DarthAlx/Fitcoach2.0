@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="recibo container-bootstrap">
			<div class="row">
				<div class="col-sm-12">
					<img src="{{url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left" style="width: 40%">

					<div class="pull-right">
						<h2>Ticket de Compra</h2>

						<p style="float: right;">
							Fecha: <br>
							Folio:
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<p>FITCOACH MEXICO S.A. DE C.V. <br>
						FME160909GB5 <br>
						Av de las Plazas #60, Sayabes T. 1302 P. 13. <br>
						Col. Bosque Real, Huixquilucan, Edo. de México <br>
						C.P. 52774
					</p>
					<p>
						Cliente:

					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<table class="table table-bordered">
						<tr>
							<td class="col-xs-1">
								Cant.
							</td>
							<td class="col-xs-3">
								Artículo
							</td>
							<td class="col-xs-4">
								Descripción
							</td>
							<td class="col-xs-2">
								Precio unitario
							</td>
							<td class="col-xs-2">
								Total
							</td>
						</tr>
					</table>
				</div>

			</div>

			<div class="row">
				<div class="col-sm-12">

						<p class="text-left">(Comprobante simplificado de operación con Público en General de acuerdo al Art. 29A FRACCIONES I Y III del Cod. Fis. de la Fed. Vigente para 2014) <br></p>
						<p class="text-center">ESTE DOCUMENTO NO ES VÁLIDO PARA EFECTOS FISCALES <br></p>
						<p class="text-center">Gracias por tu preferencia.</p>

				</div>
			</div>
		</div>
		</section>
@endsection
