<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 10/10/18
 * Time: 06:58 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\ClaseRepository;
use App\Reservacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClaseController extends Controller {

	public function clasesvista()
	{
		$month = date('m');
		$year = date('Y');
		$day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));
		$to = Cache::get('to', date('Y-m-d', mktime(0, 0, 0, $month, $day, $year)));
		$from = Cache::get('from',date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)));
		$status = Cache::get('status','*');
		if (!$status) {
			$clases = Reservacion::whereBetween('fecha', array($from, $to))->get();
		} elseif ($status == "*") {
			$clases = Reservacion::whereBetween('fecha', array($from, $to))->get();
		} else {
			$clases = Reservacion::where('status', $status)->whereBetween('fecha', array($from, $to))->get();
		}
		return view('admin.clasesvista', ['clases' => $clases, 'from' => $from, 'to' => $to, 'status' => '*']);
	}

	public function clasesvistapost(Request $request)
	{
		$from_n = strtotime($request->from);
		$to_n = strtotime($request->to);
		$from = date('Y-m-d', $from_n);
		$to = date('Y-m-d', $to_n);
		$expiresAt = Carbon::now()->addMinutes(120);
		Cache::put('from', $from, $expiresAt);
		Cache::put('to', $to, $expiresAt);
		Cache::put('status', $request->status, $expiresAt);
		if (!$request->status) {
			$clases = Reservacion::whereBetween('fecha', array($from, $to))->get();

		} elseif ($request->status == "*") {
			$clases = Reservacion::whereBetween('fecha', array($from, $to))->get();
		} else {
			$clases = Reservacion::where('status', $request->status)->whereBetween('fecha', array($from, $to))->get();

		}

		return view('admin.clasesvista', ['clases' => $clases, 'from' => $request->from, 'to' => $request->to, 'status' => $request->status]);

	}

}