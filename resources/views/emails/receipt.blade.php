<html>
		<head>
				<style type="text/css">
						body { margin: 18px; padding:50px 0; background-color: #ef7e19;}     body, table { font: 12px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { font: 11px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { border-right: 1px solid #eee; border-bottom: 1px solid #eee; }     table.border td { border-top: 1px solid #eee; border-left: 1px solid #eee; }     table span { color: #888; }
				</style>
				<title>{{$datos->folio}}</title>
		</head>
		<body bgcolor="#ef7e19">
			<p>&nbsp;</p>
				<table class="invoice" bgcolor="#ffffff" width="600px" style="margin: 50px auto;" cellspacing="0" cellpadding="6">
						<tbody>
							<tr>
								<td colspan="2">
									<img src="{{  url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left" style="width:200px;">
								</td>
							</tr>
							<tr>
								<td>
									<div class="pull-right">
										<h2>Ticket de Compra</h2>
									</div>
								</td>
								<td align="right">
									<div class="pull-right">
										<p style="float: right;">
											<strong>Fecha:</strong> {{$datos->fecha}}<br>
											<strong>Folio:</strong> {{$datos->folio}}
										</p>
									</div>
								</td>
							</tr>
								<tr>
										<td>
											<p><strong>FITCOACH MEXICO S.A. DE C.V.</strong> <br>
												FME160909GB5 <br>
												Av de las Plazas #60, Sayabes T. 1302 P. 13. <br>
												Col. Bosque Real, Huixquilucan, Edo. de México <br>
												C.P. 52774
											</p>
											<p>
												<strong>Cliente:</strong> <br>

												{{$user->name}}
											</p>
										</td>
										<td align="right"> </td>
								</tr>
								<tr>
										<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
										<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
										<td colspan="2">
										<table class="border" width="100%" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td style="width: 10%;"><span>Cant.</span></td>
																<td style="width: 30%;"><span>Artículo</span></td>
																<td style="width: 30%;"><span>Descripción</span></td>
																<td style="width: 10%;"><span>Precio unitario</span></td>
																<td style="width: 20%;"><span>Total</span></td>
														</tr>
														<?php $grantotal=0; ?>
														@foreach ($ordenes as $orden)
															<?php $tipo=explode(',',$orden->metadata);
																		$grantotal=$grantotal+intval($orden->cantidad);
															?>
														<tr class="text">
																<td style="width: 10%;">1</td>
																<td style="width: 30%;">{{$orden->nombre}}</td>
																<td style="width: 30%;">Clase {{$tipo[0]}}</td>
																<td style="width: 10%;">${{$orden->cantidad}}</td>
																<td style="width: 20%;">${{$orden->cantidad}}</td>
														</tr>
														@endforeach
												</tbody>
										</table>
										<table width="100%" class="textb" border="0" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td colspan="2"><br />
																<hr />
																</td>
														</tr>
														<?php $descuento=App\Cuponera::where('orden_id', $orden->order_id)->first(); ?>
														@if ($descuento)
															<tr>
																	<td align="right" style="width: 90%;"><strong>Descuento ({{$descuento->cupon->descripcion}}):</strong></td>
																	<td class="text">-${{ $descuento->cupon->monto }}</td>
															</tr>
														@endif
														<tr>
																<td align="right" style="width: 90%;"><strong>Subtotal:</strong></td>
																<td class="text">${{ $grantotal }}</td>
														</tr>
														<tr>
																<td align="right" style="width: 90%;"><strong>Importe total:</strong></td>
																<td class="text">${{ $grantotal }}</td>
														</tr>
														<tr>
																<td align="right" style="width: 90%;"><strong>Pagado:</strong></td>
																<td class="text">${{ $grantotal }}</td>
														</tr>

												</tbody>
										</table>
										<table width="100%" class="textb" border="0" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td>
																	<p class="text-left">(Comprobante simplificado de operación con Público en General de acuerdo al Art. 29A FRACCIONES I Y III del Cod. Fis. de la Fed. Vigente para 2014) <br></p>
																	<p class="text-center">ESTE DOCUMENTO NO ES VÁLIDO PARA EFECTOS FISCALES <br></p>
																	<p class="text-center">Gracias por tu preferencia.</p>
																</td>
														</tr>
												</tbody>
										</table>
										</td>
								</tr>
						</tbody>
				</table>
				<p>&nbsp;</p>
		</body>
</html>
