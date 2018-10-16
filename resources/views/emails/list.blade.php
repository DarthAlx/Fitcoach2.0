<html>
		<head>
				<style type="text/css">
						body { margin: 18px; }     body, table { font: 12px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { font: 11px/18px "Lucida Grande", Arial, Verdana, sans-serif; }     table.border { border-right: 1px solid #eee; border-bottom: 1px solid #eee; }     table.border td { border-top: 1px solid #eee; border-left: 1px solid #eee; }     table span { color: #888; }
				</style>
				<title>Lista</title>
		</head>
		<body>
				<table class="invoice" width="100%" cellspacing="0" cellpadding="6">
						<tbody>
							<tr>
								<td colspan="2">
									<img src="{{  url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left" style="width:200px;">
								</td>
							</tr>
							<tr>
								<td>
									<div class="pull-right">
										<h2>Lista de grupo</h2>
									</div>
								</td>
								<td align="right">
									<div class="pull-right">

									</div>
								</td>
							</tr>
								<tr>
										<td>

											<p>
												<strong>Condominio:</strong> 

												{{$condominio->identificador}}<br>

												<strong>Detalles del evento:</strong> <br>

												Fecha:{{$horario->fecha}} {{$horario->hora}}<br>
												Clase:{{$horario->clase->nombre}}<br>
												Coach:{{$horario->user->name}}<br>
												Lugar: {{$horario->grupo->condominio->identificador}}<br>{{$horario->grupo->condominio->direccion}}<br>
												Cupo: {{$horario->cupo}} personas <br>
													 Lugares disponibles: {{intval($horario->cupo)-intval($horario->ocupados)}}<br>

												Audiencia: {{$horario->audiencia}}
											</p>
										</td>
										<td align="right"> </td>
								</tr>

								<tr>
										<td colspan="2">
										<table class="border" width="100%" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td style="width: 30%;"><span>Nombre</span></td>
																<td style="width: 30%;"><span>Email</span></td>
																<td style="width: 20%;"><span>Teléfono</span></td>
																<td style="width: 20%;"><span>Genero</span></td>
														</tr>
														<?php $grantotal=0; ?>
														@foreach ($reservacion->asistentes as $asistente)
															<tr class="text">
																<td style="width: 30%;">{{$asistente->usuario->name}}</td>
																<td style="width: 30%;">{{$asistente->usuario->email}}</td>
																<td style="width: 20%;">{{$asistente->usuario->tel}}</td>
																<td style="width: 20%;">{{$asistente->usuario->genero}}</td>
															</tr>
														@endforeach
														@foreach ($reservacion->invitados as $invitados)
														<tr class="text">
																<td style="width: 30%;">{{$invitados->nombre}}</td>
																<td style="width: 30%;">{{$invitados->email}}</td>
																<td style="width: 20%;">{{$invitados->telefono}}</td>
																<td style="width: 20%;">{{$invitados->genero}}</td>
														</tr>
														@endforeach
												</tbody>
										</table>


										</td>
								</tr>
						</tbody>
				</table>
		</body>
</html>
