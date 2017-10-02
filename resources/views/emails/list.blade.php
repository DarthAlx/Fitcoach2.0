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

												Fecha:{{$residencial->fecha}} {{$residencial->hora}}<br>
												Clase:{{$residencial->clase->nombre}}<br>
												Coach:{{$residencial->user->name}}<br>
												Lugar: {{$residencial->condominio->identificador}}<br>{{$residencial->condominio->direccion}}<br>
												Cupo: {{$residencial->cupo}} personas <br>
													 Lugares disponibles: {{intval($residencial->cupo)-intval($residencial->ocupados)}}<br>

												Audiencia: {{$residencial->audiencia}}
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
														@foreach ($ordenes as $orden)
														<tr class="text">
																<td style="width: 30%;">{{$orden->user->name}}</td>
																<td style="width: 30%;">{{$orden->user->email}}</td>
																<td style="width: 20%;">{{$orden->user->tel}}</td>
																<td style="width: 20%;">{{$orden->user->genero}}</td>
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
