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
									<img src="{{  url('/images/Logo-FITCOACH.png')}}" alt="" class="pull-left">
								</td>
							</tr>
							<tr>
								<td>
									<div class="pull-right">
										<h2>Historial de pagos de {{$user->name}}</h2>
									</div>
								</td>
								<td>

								</td>
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
																<td style="width: 20%;"><span>Fecha</span></td>
																<td style="width: 30%;"><span>Método</span></td>
																<td style="width: 30%;"><span>Referencia</span></td>
																<td style="width: 20%;"><span>Balance</span></td>
														</tr>
														@foreach ($pagos as $pago)
														<tr class="text">
																<td style="width: 20%;">{{$pago->fecha}}</td>
																<td style="width: 30%;">{{$pago->metodo}}</td>
																<td style="width: 30%;">{{$pago->referencia}}</td>
																<td style="width: 20%;">{{$pago->monto}}</td>
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
