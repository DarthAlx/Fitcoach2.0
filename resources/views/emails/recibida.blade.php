<html>
		<head>
				<style type="text/css">
						body { margin: 18px; background-color: #ef7e19;}     body, table { font: 12px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { font: 11px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { border-right: 1px solid #eee; border-bottom: 1px solid #eee; }     table.border td { border-top: 1px solid #eee; border-left: 1px solid #eee; }     table span { color: #888; }
				</style>
				<title>{{$datos->folio}}</title>
		</head>
		<body bgcolor="#ef7e19">
				<table class="invoice" bgcolor="#ffffff" width="600px" style="margin: 50px auto;" cellspacing="0" cellpadding="6">
															<tbody>
																<tr>
																	<td colspan="2">

																	</td>
																</tr>
																<tr>
																	<td>
																		<div class="pull-right">
																			<h2>Nueva clase programada</h2>
																		</div>
																	</td>
																	<td align="right">
																		<div class="pull-right">
																			<p style="float: right;">
																				<strong>Fecha:</strong> {{date("Y-m-d")}}}<br>

																			</p>
																		</div>
																	</td>
																</tr>
																	<tr>
																			<td>

																				<p>
																					<strong>Estimado:</strong> <br>

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
																									<td style="width: 30%;"><span>Clientes</span></td>

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
																									<td style="width: 30%;">{{$orden->user->name}}</td>

																							</tr>
																							@endforeach
																					</tbody>
																			</table>

																			<table width="100%" class="textb" border="0" cellspacing="0" cellpadding="6">
																					<tbody>
																							<tr>
																									<td>
																										<p class="text-left">Revisa tu perfil para saber todos los detalles de la clase. <br></p>

																										<p class="text-center">Gracias por ser parte de FITCOACH.</p>
																									</td>
																							</tr>
																					</tbody>
																			</table>
																			</td>
																	</tr>
															</tbody>
													</table>
                        </td>
                    </tr>
                </tbody></table>
							</body>
					</html>
