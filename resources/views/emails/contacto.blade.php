<html>
		<head>
				<style type="text/css">
						body { margin: 18px; }     body, table { font: 12px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { font: 11px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { border-right: 1px solid #eee; border-bottom: 1px solid #eee; }     table.border td { border-top: 1px solid #eee; border-left: 1px solid #eee; }     table span { color: #888; }
				</style>
		</head>
		<body>
				<table class="invoice" width="100%" cellspacing="0" cellpadding="6">
						<tbody>
							<tr>
								<td colspan="2">
									<img src="{{url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left" style="width: 20%">
								</td>
							</tr>
							<tr>
								<td>
									<div class="pull-right">
										<h2>Contacto</h2>
									</div>
								</td>
								<td>
								</td>
							</tr>


								<tr>
										<td colspan="2">
										<table width="100%" class="textb" border="0" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td colspan="2"><br />
																	Tienes un nuevo mensaje desde contacto FITCOACH.
																<hr />
																</td>
														</tr>
														<tr>
																<td align="left" style="width: 90%;"><strong>Nombre:</strong></td>
																<td class="text">{{ $datos->nombre}}</td>
														</tr>
														<tr>
																<td align="left" style="width: 90%;"><strong>Email:</strong></td>
																<td class="text">{{ $datos->email}}</td>
														</tr>
														<tr>
																<td align="left" style="width: 90%;"><strong>Teléfono:</strong></td>
																<td class="text">{{ $datos->tel}}</td>
														</tr>
														<tr>
																<td align="left" style="width: 90%;"><strong>Mensaje:</strong></td>
																<td class="text">{{ $datos->msg}}</td>
														</tr>

												</tbody>
										</table>
										</td>
								</tr>
						</tbody>
				</table>
		</body>
</html>
