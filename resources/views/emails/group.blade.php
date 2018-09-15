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
										<?php
										$fecha = date('Y-m-d');
										$fechas=array();
										$fechasformateadas=array();
										setlocale(LC_TIME, "es-MX");
										date_default_timezone_set('America/Mexico_City');

										for ($i=0; $i < 15 ; $i++) {
											$nuevafecha = strtotime ( '+'.$i.'day' , strtotime ( $fecha ) ) ;
											$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
											$format=date("d", strtotime($nuevafecha));
											$numdias=date("w", strtotime($nuevafecha));
											$nummeses=date("n", strtotime($nuevafecha));
											$arraydia=array('Dom','Lun','Mar','Mié','Jue','Vie','Sáb');
											$arraymes=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto', 'Septiembre','Octubre','Noviembre','Diciembre');
											$num=$arraydia[intval($numdias)];
											$nummes=$arraymes[intval($nummeses)-1];
											$fechas[]= $nuevafecha;
											$fechasformateadas[]=ucfirst($num . " " . $format . " " .$nummes);
										}
										?>
										<h2>Gupos pendientes de {{reset($fechas)}} a {{end($fechas)}}
      </h2>
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

											</p>
										</td>
										<td align="right"> </td>
								</tr>

								<tr>
										<td colspan="2">
										<table class="border" width="100%" cellspacing="0" cellpadding="6">
												<tbody>
														<tr>
																<td style="width: 20%;"><span>Fecha</span></td>
																<td style="width: 20%;"><span>Coach</span></td>
																<td style="width: 20%;"><span>Clase</span></td>
																<td style="width: 20%;"><span>Tipo</span></td>
																<td style="width: 10%;"><span>Cupo</span></td>
																<td style="width: 10%;"><span>Ocupados</span></td>
														</tr>


														@foreach ($residenciales as $residencial)
															@if (in_array($residencial->fecha, $fechas))
																<tr class="text">

																		<td style="width: 20%;">{{$residencial->fecha}} {{$residencial->hora}}</td>
																		<td style="width: 20%;">{{$residencial->user->name}}</td>
																		<td style="width: 20%;">{{$residencial->clase->nombre}}</td>
																		<td style="width: 20%;">{{$residencial->tipo}}</td>
																		<td style="width: 10%;">{{$residencial->cupo}}</td>
																		<td style="width: 10%;">{{$residencial->ocupados}}</td>
																</tr>
															@endif

														@endforeach
												</tbody>
										</table>


										</td>
								</tr>
						</tbody>
				</table>
		</body>
</html>
